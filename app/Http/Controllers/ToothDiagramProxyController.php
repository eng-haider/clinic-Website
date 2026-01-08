<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToothDiagramProxyController extends Controller
{
    /**
     * Proxy the tooth diagram content from external source
     * This bypasses X-Frame-Options restrictions
     */
    public function show($patientCode)
    {
        try {
            // Fetch the content from the external URL
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification if needed
                'allow_redirects' => true,
            ])->timeout(30)->get("https://smartclinicv4.tctate.com/public/teeth/{$patientCode}");
            
            if ($response->successful()) {
                // Get the HTML content
                $content = $response->body();
                
                // Check if we actually got content
                if (empty($content)) {
                    return response('<html><body style="font-family: Arial; text-align: center; padding: 50px; direction: rtl;"><h2>عذراً، المحتوى فارغ</h2><p>لم يتم استلام بيانات من الخادم</p></body></html>', 200)
                        ->header('Content-Type', 'text/html; charset=utf-8');
                }
                
                // Inject base tag to fix relative URLs
                $baseTag = '<base href="https://smartclinicv4.tctate.com/">';
                $content = str_replace('<head>', '<head>' . $baseTag, $content);
                
                // Remove or neutralize history manipulation that causes SecurityError
                // This fixes: "Failed to execute 'replaceState' on 'History'"
                $content = preg_replace('/history\.(pushState|replaceState)/i', '// history.$1', $content);
                $content = preg_replace('/window\.history\.(pushState|replaceState)/i', '// window.history.$1', $content);
                
                // Also disable popstate events that might cause issues
                $content = str_replace('popstate', 'x-popstate-disabled', $content);
                
                // Inject script to disable history manipulation at runtime (silent no-op)
                $securityScript = "
                <script>
                (function(){
                    try {
                        // Replace history methods with silent no-ops to avoid cross-origin SecurityError
                        if (window.history) {
                            window.history.pushState = function(){};
                            window.history.replaceState = function(){};
                        }

                        // Prevent registering popstate listeners inside iframe
                        const _addEvent = window.addEventListener;
                        window.addEventListener = function(type, listener, options){
                            if (String(type).toLowerCase() === 'popstate') return;
                            return _addEvent.call(this, type, listener, options);
                        };

                        // Neutralize onpopstate assignment
                        try {
                            Object.defineProperty(window, 'onpopstate', {
                                configurable: true,
                                enumerable: true,
                                get: function(){ return null; },
                                set: function(v) { /* ignore */ }
                            });
                        } catch(e) {
                            // ignore
                        }
                    } catch(e) {
                        // ignore
                    }
                })();
                </script>
                ";
                
                $content = str_replace('</head>', $securityScript . '</head>', $content);
                
                // Return the content with proper headers
                return response($content)
                    ->header('Content-Type', 'text/html; charset=utf-8')
                    ->header('X-Frame-Options', 'ALLOWALL') // Allow iframe embedding
                    ->header('Content-Security-Policy', "frame-ancestors *"); // Allow embedding from any origin
            }
            
            // Not successful - show error with status code
            return response('<html><body style="font-family: Arial; text-align: center; padding: 50px; direction: rtl;"><h2>عذراً، لا يمكن تحميل مخطط الأسنان</h2><p>كود الحالة: ' . $response->status() . '</p><p>حاول مرة أخرى لاحقاً</p></body></html>', 200)
                ->header('Content-Type', 'text/html; charset=utf-8');
                
        } catch (\Exception $e) {
            // Show detailed error for debugging
            $errorMessage = htmlspecialchars($e->getMessage());
            return response('<html><body style="font-family: Arial; text-align: center; padding: 50px; direction: rtl;"><h2>خطأ في الاتصال</h2><p>' . $errorMessage . '</p><p>يرجى المحاولة مرة أخرى</p></body></html>', 200)
                ->header('Content-Type', 'text/html; charset=utf-8');
        }
    }
}
