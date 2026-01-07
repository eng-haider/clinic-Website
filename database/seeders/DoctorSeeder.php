<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'د. سارة جونسون',
                'specialization' => 'طب الأسنان العام',
                'degree' => 'دكتوراه في طب الأسنان، كلية هارفارد لطب الأسنان',
                'bio' => 'د. سارة جونسون لديها أكثر من 15 عامًا من الخبرة في طب الأسنان العام. هي متحمسة لتقديم رعاية أسنان شاملة وبناء علاقات دائمة مع مرضاها. د. جونسون تواكب أحدث تقنيات وأساليب طب الأسنان لضمان أفضل رعاية ممكنة.',
                'image' => 'team-1.webp',
                'email' => 'sarah.johnson@clinic.com',
                'phone' => '+1 (555) 123-4567',
                'social_links' => [
                    'facebook' => 'https://facebook.com/drsarahjohnson',
                    'twitter' => 'https://twitter.com/drsarahjohnson',
                    'linkedin' => 'https://linkedin.com/in/drsarahjohnson',
                ],
                'experience_years' => 15,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'د. مايكل تشين',
                'specialization' => 'تقويم الأسنان',
                'degree' => 'دكتوراه في طب الأسنان، ماجستير، كلية طب الأسنان بجامعة كاليفورنيا',
                'bio' => 'د. مايكل تشين هو أخصائي تقويم أسنان معتمد يتمتع بشغف لخلق ابتسامات جميلة وصحية. يتخصص في كل من التقويم التقليدي والعلاج بالمصففات الشفافة. د. تشين يفخر بنهجه الشخصي في رعاية تقويم الأسنان، مما يضمن حصول كل مريض على خطة علاج مصممة خصيصًا لاحتياجاته الفريدة.',
                'image' => 'team-2.webp',
                'email' => 'michael.chen@clinic.com',
                'phone' => '+1 (555) 234-5678',
                'social_links' => [
                    'facebook' => 'https://facebook.com/drmichaelchen',
                    'twitter' => 'https://twitter.com/drmichaelchen',
                    'instagram' => 'https://instagram.com/drmichaelchen',
                ],
                'experience_years' => 12,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'د. إيميلي رودريغيز',
                'specialization' => 'طب أسنان الأطفال',
                'degree' => 'دكتوراه في طب الأسنان، شهادة في طب أسنان الأطفال',
                'bio' => 'د. إيميلي رودريغيز كرست حياتها المهنية لجعل زيارات الأسنان ممتعة ومريحة للأطفال. مع نهج لطيف وشخصية دافئة، تساعد الأطفال على تطوير عادات صحية للأسنان تدوم مدى الحياة. د. رودريغيز مدربة بشكل خاص على علاج الأطفال من سن الرضاعة حتى المراهقة.',
                'image' => 'team-3.webp',
                'email' => 'emily.rodriguez@clinic.com',
                'phone' => '+1 (555) 345-6789',
                'social_links' => [
                    'facebook' => 'https://facebook.com/dremilyrodriguez',
                    'instagram' => 'https://instagram.com/dremilyrodriguez',
                ],
                'experience_years' => 10,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'د. ديفيد ويليامز',
                'specialization' => 'جراحة الفم',
                'degree' => 'دكتوراه في طب الأسنان، دكتوراه في الطب، جامعة جونز هوبكنز',
                'bio' => 'د. ديفيد ويليامز هو جراح فم وفكين حاصل على درجتين مع خبرة واسعة في إجراءات الأسنان المعقدة. يتخصص في زراعة الأسنان، خلع ضرس العقل، وجراحة الفك التصحيحية. د. ويليامز معروف بدقته وخبرته ورعايته الرحيمة للمرضى.',
                'image' => 'team-4.webp',
                'email' => 'david.williams@clinic.com',
                'phone' => '+1 (555) 456-7890',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/drdavidwilliams',
                    'twitter' => 'https://twitter.com/drdavidwilliams',
                ],
                'experience_years' => 18,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'د. ليزا أندرسون',
                'specialization' => 'طب الأسنان التجميلي',
                'degree' => 'دكتوراه في طب الأسنان، شهادة متقدمة في طب الأسنان التجميلي',
                'bio' => 'د. ليزا أندرسون فنانة في القلب، متخصصة في إجراءات طب الأسنان التجميلية التي تحول الابتسامات. من القشور والترابط إلى تجميل الابتسامة الكامل، تجمع بين الخبرة التقنية والعين للجماليات. د. أندرسون ملتزمة بمساعدة المرضى على تحقيق ابتسامة أحلامهم.',
                'image' => 'team-5.webp',
                'email' => 'lisa.anderson@clinic.com',
                'phone' => '+1 (555) 567-8901',
                'social_links' => [
                    'facebook' => 'https://facebook.com/drlisaanderson',
                    'instagram' => 'https://instagram.com/drlisaanderson',
                    'linkedin' => 'https://linkedin.com/in/drlisaanderson',
                ],
                'experience_years' => 14,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'د. جيمس تايلور',
                'specialization' => 'علاج جذور الأسنان',
                'degree' => 'دكتوراه في طب الأسنان، ماجستير في علاج جذور الأسنان',
                'bio' => 'د. جيمس تايلور متخصص في علاج جذور الأسنان، مع التركيز على إنقاذ الأسنان الطبيعية من خلال علاج قناة الجذر. مع التدريب المتقدم والمعدات الحديثة، يوفر علاجًا مريحًا وفعالًا حتى للحالات الأكثر تعقيدًا. نهج د. تايلور اللطيف يجعل المرضى القلقين يشعرون بالراحة.',
                'image' => 'team-6.webp',
                'email' => 'james.taylor@clinic.com',
                'phone' => '+1 (555) 678-9012',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/drjamestaylor',
                ],
                'experience_years' => 11,
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
