<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => '5 نصائح أساسية للحفاظ على أسنان صحية',
                'slug' => Str::slug('5-نصائح-أساسية-للحفاظ-على-أسنان-صحية'),
                'content' => '<p>الحفاظ على أسنان صحية أمر بالغ الأهمية لرفاهيتك بشكل عام. إليك خمس نصائح أساسية للحفاظ على ابتسامتك مشرقة وصحية:</p>
                
                <h3>1. اغسل أسنانك مرتين يوميًا</h3>
                <p>تنظيف أسنانك مرتين على الأقل يوميًا بمعجون أسنان بالفلورايد هو أساس النظافة الفموية الجيدة. تأكد من التنظيف لمدة دقيقتين على الأقل، وتغطية جميع أسطح أسنانك.</p>
                
                <h3>2. لا تتخطى استخدام الخيط</h3>
                <p>يزيل الخيط البلاك وجزيئات الطعام من بين أسنانك حيث لا تستطيع فرشاة أسنانك الوصول. اجعلها عادة يومية، ويفضل قبل النوم.</p>
                
                <h3>3. فحوصات الأسنان المنتظمة</h3>
                <p>قم بزيارة طبيب أسنانك مرتين على الأقل سنويًا للتنظيف والفحوصات المهنية. الكشف المبكر عن مشاكل الأسنان يمكن أن يوفر لك الوقت والمال والانزعاج.</p>
                
                <h3>4. راقب نظامك الغذائي</h3>
                <p>قلل من الأطعمة والمشروبات السكرية والحمضية. بدلاً من ذلك، اختر الأطعمة الصديقة للأسنان مثل الجبن والمكسرات والخضروات المقرمشة التي يمكن أن تساعد في تنظيف أسنانك بشكل طبيعي.</p>
                
                <h3>5. ابق رطبًا</h3>
                <p>شرب الكثير من الماء يساعد على غسل جزيئات الطعام والبكتيريا. كما يساعد في الحفاظ على إنتاج اللعاب، وهو دفاع فمك الطبيعي ضد تسوس الأسنان.</p>',
                'featured_image' => 'blog-1.webp',
                'author' => 'د. سارة جونسون',
                'category' => 'العناية بالأسنان',
                'tags' => ['النظافة الفموية', 'نصائح الأسنان', 'الرعاية الوقائية'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Understanding Dental Implants: A Complete Guide',
                'slug' => Str::slug('Understanding Dental Implants: A Complete Guide'),
                'content' => '<p>Dental implants have revolutionized the way we replace missing teeth. This comprehensive guide will help you understand everything about dental implants.</p>
                
                <h3>What Are Dental Implants?</h3>
                <p>Dental implants are titanium posts that are surgically placed into your jawbone to serve as artificial tooth roots. They provide a strong foundation for fixed or removable replacement teeth.</p>
                
                <h3>Benefits of Dental Implants</h3>
                <ul>
                    <li>Look and feel like natural teeth</li>
                    <li>Prevent bone loss in the jaw</li>
                    <li>Don\'t require altering adjacent teeth</li>
                    <li>Can last a lifetime with proper care</li>
                    <li>Restore full chewing function</li>
                </ul>
                
                <h3>The Implant Process</h3>
                <p>The process typically involves several stages: initial consultation, implant placement surgery, healing period (osseointegration), and finally, placement of the crown or prosthetic tooth.</p>
                
                <h3>Are You a Candidate?</h3>
                <p>Most healthy adults with adequate jawbone density are good candidates for dental implants. A consultation with your dentist can determine if implants are right for you.</p>',
                'featured_image' => 'blog-2.webp',
                'author' => 'Dr. David Williams',
                'category' => 'Dental Procedures',
                'tags' => ['dental implants', 'tooth replacement', 'oral surgery'],
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'How to Prepare Your Child for Their First Dental Visit',
                'slug' => Str::slug('How to Prepare Your Child for Their First Dental Visit'),
                'content' => '<p>Taking your child to the dentist for the first time can be nerve-wracking for both parents and children. Here\'s how to make it a positive experience.</p>
                
                <h3>Start Early</h3>
                <p>The American Academy of Pediatric Dentistry recommends that children visit the dentist by their first birthday or within six months of their first tooth emerging.</p>
                
                <h3>Make It Fun</h3>
                <p>Read books about visiting the dentist, play dentist at home, and speak positively about the experience. Avoid using the dentist as a threat or punishment.</p>
                
                <h3>Choose the Right Time</h3>
                <p>Schedule the appointment when your child is well-rested and in a good mood. Morning appointments often work best for young children.</p>
                
                <h3>What to Expect</h3>
                <p>The first visit is usually short and simple. The dentist will examine your child\'s teeth, gums, and jaw, and may clean their teeth gently. It\'s also an opportunity to discuss proper oral care.</p>
                
                <h3>Stay Calm and Positive</h3>
                <p>Children pick up on their parents\' emotions. Stay relaxed and enthusiastic to help your child feel comfortable and confident.</p>',
                'featured_image' => 'blog-3.webp',
                'author' => 'Dr. Emily Rodriguez',
                'category' => 'Pediatric Dentistry',
                'tags' => ['children\'s dentistry', 'first dental visit', 'pediatric care'],
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'The Truth About Teeth Whitening: Myths vs Facts',
                'slug' => Str::slug('The Truth About Teeth Whitening: Myths vs Facts'),
                'content' => '<p>Teeth whitening is one of the most popular cosmetic dental procedures, but there are many misconceptions about it. Let\'s separate fact from fiction.</p>
                
                <h3>Myth: Whitening Damages Your Teeth</h3>
                <p><strong>Fact:</strong> Professional teeth whitening performed by a dentist is safe and does not damage tooth enamel when done correctly.</p>
                
                <h3>Myth: All Whitening Products Work the Same</h3>
                <p><strong>Fact:</strong> Professional whitening treatments are more effective and faster than over-the-counter products. They also provide more consistent results.</p>
                
                <h3>Myth: Results Last Forever</h3>
                <p><strong>Fact:</strong> Whitening results typically last 6 months to 2 years, depending on your habits. Avoiding staining foods and drinks can help maintain your results longer.</p>
                
                <h3>Myth: Whitening Works on All Teeth</h3>
                <p><strong>Fact:</strong> Whitening works best on natural teeth. It won\'t change the color of crowns, veneers, or fillings. Some types of stains also respond better to whitening than others.</p>
                
                <h3>Best Practices</h3>
                <p>For safe and effective whitening, always consult with your dentist first to determine the best option for your specific needs.</p>',
                'featured_image' => 'blog-4.webp',
                'author' => 'Dr. Lisa Anderson',
                'category' => 'Cosmetic Dentistry',
                'tags' => ['teeth whitening', 'cosmetic dentistry', 'dental myths'],
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Signs You Need a Root Canal and What to Expect',
                'slug' => Str::slug('Signs You Need a Root Canal and What to Expect'),
                'content' => '<p>Root canals have a bad reputation, but they\'re actually a pain-relieving procedure that saves your natural tooth. Here\'s what you need to know.</p>
                
                <h3>Warning Signs</h3>
                <ul>
                    <li>Severe toothache when chewing or applying pressure</li>
                    <li>Prolonged sensitivity to hot or cold</li>
                    <li>Darkening or discoloration of the tooth</li>
                    <li>Swollen or tender gums</li>
                    <li>Persistent or recurring pimple on the gums</li>
                </ul>
                
                <h3>The Procedure</h3>
                <p>During a root canal, the infected pulp is removed, the inside of the tooth is cleaned and disinfected, then filled and sealed. Modern anesthesia makes the procedure comfortable.</p>
                
                <h3>Recovery</h3>
                <p>Most patients experience mild discomfort for a few days after the procedure, which can be managed with over-the-counter pain medication. The tooth typically requires a crown for protection.</p>
                
                <h3>Success Rate</h3>
                <p>Root canals have a success rate of over 95%. With proper care, a tooth that has had a root canal can last a lifetime.</p>',
                'featured_image' => 'blog-5.webp',
                'author' => 'Dr. James Taylor',
                'category' => 'Dental Procedures',
                'tags' => ['root canal', 'endodontics', 'tooth pain'],
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
            [
                'title' => 'Orthodontic Treatment Options: Braces vs Invisalign',
                'slug' => Str::slug('Orthodontic Treatment Options: Braces vs Invisalign'),
                'content' => '<p>Thinking about straightening your teeth? Here\'s a comprehensive comparison of traditional braces and Invisalign clear aligners.</p>
                
                <h3>Traditional Braces</h3>
                <p><strong>Pros:</strong></p>
                <ul>
                    <li>Can treat complex alignment issues</li>
                    <li>Often faster treatment time</li>
                    <li>No compliance issues (can\'t be removed)</li>
                    <li>Usually more cost-effective</li>
                </ul>
                <p><strong>Cons:</strong></p>
                <ul>
                    <li>More visible (unless using ceramic braces)</li>
                    <li>Dietary restrictions</li>
                    <li>Harder to clean teeth</li>
                </ul>
                
                <h3>Invisalign Clear Aligners</h3>
                <p><strong>Pros:</strong></p>
                <ul>
                    <li>Nearly invisible</li>
                    <li>Removable for eating and cleaning</li>
                    <li>No food restrictions</li>
                    <li>Fewer office visits</li>
                </ul>
                <p><strong>Cons:</strong></p>
                <ul>
                    <li>Requires discipline to wear 22 hours daily</li>
                    <li>May not be suitable for complex cases</li>
                    <li>Generally more expensive</li>
                    <li>Can be lost or damaged</li>
                </ul>
                
                <h3>Which Is Right for You?</h3>
                <p>The best choice depends on your specific orthodontic needs, lifestyle, and budget. Schedule a consultation with an orthodontist to discuss your options.</p>',
                'featured_image' => 'blog-6.webp',
                'author' => 'Dr. Michael Chen',
                'category' => 'Orthodontics',
                'tags' => ['braces', 'invisalign', 'orthodontics', 'teeth straightening'],
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
