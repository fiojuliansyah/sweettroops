<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        DB::table('homepages')->insert([
            'title' => 'Kelas Berbasis Cinta',
            'sub_title' => 'Kami telah menawarkan kelas baking berkualitas tinggi. Setiap kelas dirancang dengan penuh cinta untuk membantu Anda menguasai keterampilan praktis yang akan membawa Anda ke level berikutnya dalam dunia baking.',
            'detail' => 'Di SweetTroops Baking Studio, kami percaya bahwa proses belajar harus menyenangkan dan menginspirasi. Kami tidak hanya mengajarkan resep, tetapi juga memberi Anda keterampilan yang akan Anda gunakan sepanjang hidup. Dengan instruktur berpengalaman dan bahan berkualitas tinggi, kami menciptakan pengalaman belajar yang tak terlupakan. Apakah Anda seorang pemula atau ingin meningkatkan keterampilan baking Anda, kelas kami dirancang untuk memberikan pengalaman langsung yang menyenangkan dan edukatif. Bergabunglah dengan kami dan temukan kecintaan Anda pada dunia baking sambil mengembangkan keahlian praktis di setiap langkahnya.',
            'tab_1' => 'Kenapa Memilih Kelas Kami?',
            'title_tab_1' => 'Kenapa Memilih Kelas Kami?',
            'detail_tab_1' => 'Kelas baking kami didesain untuk memberikan pengalaman langsung dalam membuat kue yang lezat dan berkualitas. Kami menawarkan kursus yang mudah diikuti, baik untuk pemula maupun profesional. Dengan pengajaran dari instruktur berpengalaman, Anda akan menguasai teknik-teknik dasar hingga tingkat lanjut. Kami percaya bahwa setiap orang bisa menjadi ahli dalam membuat kue dengan latihan yang tepat dan bahan yang berkualitas. Apakah Anda ingin belajar cara membuat kue-kue khas atau menciptakan kreasi kue unik Anda sendiri? Kami siap membantu Anda mencapai tujuan tersebut dalam kelas praktis yang menyenangkan dan bermanfaat.',
            'tab_2' => 'Filosofi Pengajaran',
            'title_tab_2' => 'ilosofi Pengajaran',
            'detail_tab_2' => 'Di SweetTroops Baking Studio, kami memprioritaskan pendekatan pembelajaran yang menyenangkan dan penuh kreativitas. Filosofi kami adalah menggabungkan teknik-teknik tradisional dengan inovasi terkini dalam dunia baking. Setiap peserta akan diajarkan tidak hanya cara membuat kue, tetapi juga bagaimana mengekspresikan diri melalui kreasi makanan. Belajar bersama kami adalah tentang mengembangkan passion dan keterampilan dalam membuat kue yang luar biasa.',
            'tab_3' => 'Kualitas Pengajaran',
            'title_tab_3' => 'Kualitas Pengajaran',
            'detail_tab_3' => 'Kami memastikan setiap kelas yang kami tawarkan memiliki standar tinggi dalam pengajaran dan pengalaman belajar. Dengan instruktur yang berpengalaman dan berpengetahuan luas, kami memberikan pelatihan yang sangat praktis dan mudah dipahami. Semua peserta akan mendapat perhatian penuh untuk mengasah keterampilan mereka. Di SweetTroops, kualitas pengajaran adalah prioritas kami agar setiap peserta dapat belajar dengan percaya diri dan hasil yang maksimal. Dengan pendekatan hands-on, setiap peserta akan langsung terlibat dalam setiap langkah pembuatan kue, memastikan pemahaman yang mendalam dan keterampilan yang terasah dengan baik.',
            'section_title' => 'Tertarik Mengikuti Kelas Baru?',
            'section_sub_title' => 'Apakah Anda ingin belajar langsung dari ahli di bidangnya? Kami menawarkan berbagai kelas membuat kue yang bisa diikuti secara langsung atau online, sesuai dengan kebutuhan Anda. Jangan ragu untuk menghubungi kami untuk informasi lebih lanjut dan untuk memesan kelas sesuai preferensi Anda.',
            'section_detail' => 'Apakah Anda ingin belajar langsung dari ahli di bidangnya? Kami menawarkan berbagai kelas membuat kue yang bisa diikuti secara langsung atau online, sesuai dengan kebutuhan Anda. Jangan ragu untuk menghubungi kami untuk informasi lebih lanjut dan untuk memesan kelas sesuai preferensi Anda.',
            'section_button' => 'Hubungi Kami',
            'section_link' => 'https://wa.me/62',
            'accord_title' => 'Pertanyaan yang Sering Diajukan tentang Kelas',
            'accord_detail' => 'Berikut adalah beberapa pertanyaan yang sering kami terima terkait dengan kelas baking kami. Jika Anda memiliki pertanyaan lain, jangan ragu untuk menghubungi kami. Kami siap membantu Anda dengan semua kebutuhan terkait kursus dan pelatihan kami!',
            'accord_tab_1' => 'How to Get Started?',
            'accord_detail_tab_1' => 'Ya, kami menawarkan kelas baking online bagi Anda yang ingin belajar di rumah. Anda bisa mengikuti kursus ini dari mana saja dengan instruksi langsung dari instruktur kami yang berpengalaman.',
            'accord_tab_2' => 'What Courses Do You Offer?',
            'accord_detail_tab_2' => 'Anda dapat mendaftar untuk kelas baking kami langsung melalui situs web kami. Cukup pilih kelas yang Anda inginkan, pilih jadwal yang sesuai, dan lakukan pembayaran untuk mengamankan tempat Anda.',
            'accord_tab_3' => 'Is There a Fee?',
            'accord_detail_tab_3' => 'Ya, kami menawarkan kelas untuk pemula yang ingin belajar dasar-dasar baking. Instruktur kami akan memandu Anda langkah demi langkah dalam membuat kue dan hidangan lainnya dengan mudah.',
            'contact_title' => 'Contact Us',
            'contact_detail' => 'If you have any questions or need support, feel free to contact us.',
            'email' => 'support@example.com',
            'hours' => 'Monday to Friday, 9 AM to 6 PM',
            'location' => '1234 Learning St, Cityville, Country',
            'phone' => '123-456-7890',
            'map_url' => 'https://maps.example.com/location',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
