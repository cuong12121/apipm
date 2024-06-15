<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Carbon\Carbon;

class crawlController extends Controller
{


    public function crawPostTinhTe()
    {

        $crawl = DB::table('link_crawl')->get();

        $now   = Carbon::now();

        foreach ($crawl as $link) {

            $update_link = DB::table('link_crawl')->where('id', $link->id)->where('active', 0)->update(['active'=>1]);

            $html = file_get_html($link->link);

            $title = strip_tags($html->find('.entry-title', 0));

            $content = html_entity_decode($html->find('.page-content', 0));

            $insert = DB::table('post_crawl')->insert(['title'=>$title, 'content'=>$content, 'created_at'=>$now, 'updated_at'=>$now]);
        }
        echo "thành công";
       

    }


    public function vietnameseToEnglish($text) {
        // Chuyển đổi dấu câu
        $text = preg_replace('/[,\.;?!]/u', '.', $text);

        // Chuyển đổi chữ có dấu
        $patterns = array(
            '/[áàảãạăắằẳẵặâấầẩẫậ]/u',
            '/[éèẻẽẹêếềểễệ]/u',
            '/[óòỏõọôốồổỗộơớờởỡợ]/u',
            '/[íìỉĩị]/u',
            '/[úùủũụưứừửữự]/u',
            '/[ýỳỷỹỵ]/u',
            '/đ/u'
        );
        $replacements = array('a', 'e', 'o', 'i', 'u', 'y', 'd');
        $text = preg_replace($patterns, $replacements, $text);

        // Chuyển đổi từ/cụm từ (ví dụ)
        $text = str_replace('xin chào', 'hello', $text);

        return $text;
    }

    public function convert_name_file()
    {
        $data = DB::table('fs_order_uploads')->select('file_pdf','id')->whereBetween('id', [189222, 199425])->get();
        $dem = 0;

        foreach ($data as $key => $value) {

            $url = str_replace('files/orders/2024', 'https://cachsuadienmay.vn/public', $value->file_pdf);

            if(!file_exists($url)){
                $dem++;
                $insert = ['file'=>$url, 'record_id'=>$value->id];
                DB::table('check_error_pdf')->insert($insert);
                echo $dem;

            }
            
        }
        echo "thanh cong";

        
    }



    public function getLink()
    {

        $html = file_get_html('https://thegioidieuhoa.com.vn/danhmuc/tin-tuc-dieu-hoa/');

        $href = $html->find('.elementor-post__title a');

        foreach ($href as $key => $value) {

            DB::table('link_crawl')->insert(['link'=>$value->getAttribute('href'), 'active'=>0]);
           
        }
        echo "thành công";

    }

    public function viewListCrawl()
    {
        return view('crawl-table');
    }

    public function viewDetail($id)
    {

        $data = DB::table('post_crawl')->where('id', $id)->first();
        if(!empty($data)){
            return view('post-detail', compact('data'));
        }
        return abort('404');
        
    }
}
