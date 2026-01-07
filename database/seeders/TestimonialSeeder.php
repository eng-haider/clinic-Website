<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'patient_name' => 'جون سميث',
                'patient_title' => 'صاحب عمل',
                'content' => 'كانت تجربتي رائعة في هذه العيادة. د. سارة جونسون وفريقها كانوا محترفين ومهتمين وجعلوني أشعر بالراحة التامة. إجراء تبييض الأسنان فاق توقعاتي!',
                'rating' => 5,
                'image' => 'client-1.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'ماريا غارسيا',
                'patient_title' => 'معلمة',
                'content' => 'د. إيميلي رودريغيز رائعة مع الأطفال! أطفالي الآن يتطلعون بالفعل لمواعيد الأسنان. الموظفون ودودون والمكتب نظيف ومرحب. أوصي بشدة!',
                'rating' => 5,
                'image' => 'client-2.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'روبرت براون',
                'patient_title' => 'مهندس',
                'content' => 'كنت متوترًا بشأن زراعة الأسنان، لكن د. ديفيد ويليامز جعل العملية بأكملها سلسة وخالية من الألم. النتائج لا تصدق - أسناني الجديدة تبدو وتشعر طبيعية تمامًا!',
                'rating' => 5,
                'image' => 'client-3.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'جينيفر لي',
                'patient_title' => 'مديرة تسويق',
                'content' => 'د. ليزا أندرسون أعطتني الابتسامة التي طالما أردتها! العمل التجميلي الذي قامت به كان مثاليًا تمامًا. لا أستطيع التوقف عن الابتسام الآن. الفريق بأكمله محترف ومهتم.',
                'rating' => 5,
                'image' => 'client-4.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'توماس ويلسون',
                'patient_title' => 'محاسب',
                'content' => 'كنت بحاجة إلى علاج قناة الجذر وكنت أخشاه، لكن د. جيمس تايلور جعله خاليًا تمامًا من الألم. خبرته ونهجه اللطيف حول الموقف المجهد إلى تجربة إيجابية.',
                'rating' => 5,
                'image' => 'client-5.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'أماندا مارتينيز',
                'patient_title' => 'مصممة جرافيك',
                'content' => 'د. مايكل تشين حول ابتسامتي بالإنفزلاين. كانت العملية أسهل مما توقعت والنتائج رائعة! العيادة حديثة والموظفون دائمًا مفيدون.',
                'rating' => 5,
                'image' => 'client-6.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'دانيال كيم',
                'patient_title' => 'مطور برمجيات',
                'content' => 'خدمة متميزة من البداية للنهاية! الجدولة مريحة، المرافق من الدرجة الأولى، ورعاية الأسنان استثنائية. هذه هي أفضل عيادة أسنان ذهبت إليها على الإطلاق.',
                'rating' => 5,
                'image' => 'client-7.webp',
                'is_active' => true,
            ],
            [
                'patient_name' => 'سارة طومسون',
                'patient_title' => 'ممرضة',
                'content' => 'كمهنية رعاية صحية بنفسي، أنا حقًا أقدر جودة الرعاية المقدمة هنا. الفريق على دراية، يستخدم أحدث التقنيات، ويهتم حقًا بمرضاهم.',
                'rating' => 5,
                'image' => 'client-8.webp',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
