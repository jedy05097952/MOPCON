<?php
include __DIR__.'/src/Savant3.php';

$config = [
    'template_path' => array(__DIR__.'/tpl/')
];
$tpl = new Savant3($config);

$tpl->title = "媒體合作";
$tpl->mainClass = ' ⃠-black-box';

$tpl->hacker = [
    [
        'id'   => 'iThome',
        'name' => 'iThome',
        'img'  => 'iThomelogo.png',
        'url'  => 'http://www.ithome.com.tw/',
        'desc' => '<p>iThome 讓你全盤了解IT天下事
        <p><a href="http://www.ithome.com.tw/">http://www.ithome.com.tw/</a><br><br>
         
         <p>iThome是臺灣第一個網路原生報，提供IT產業即時新聞、企業IT產品報導與測試、技術專題、IT應用報導等。旗下包括iThome電腦報周刊和多個IT社群網站服務。iThome電腦報周刊是國內第一本專為IT領導者及專業工作者量身打造的周刊，新聞資訊報導最深入，國內外IT產業領袖和企業CIO採訪數量最多的、企業IT產品報導最多、測試最完整的企業IT雜誌。
         旗下設立了一個「IT邦幫忙」社群網站。這是一個IT知識社群聚落，透過問、答與知識分享的方式，解決工作上的問題；上萬個IT實戰寶貴經驗，數千個IT人無私熱血解答。連續6年舉辦IT邦幫忙鐵人賽，挑戰連續30天不中斷發文，吸引了臺灣IT人熱切參賽。
         另外還有兩個資訊服務類型的網站，一個是「iThome download」網站。這是一個全新型態的下載網站，軟體數量多、版本更新快，這裡有的不只是軟體，還有軟體評價、評論與解決方案，更設立企業軟體專區，是尋找軟體時的最佳選擇。另一個服務網站則是「apphome」，以分享iOS、Android、Windows Phone等各式行動裝置平臺的好用應用程式及限免資訊，還有app新聞，行動裝置、筆電等開箱及最新3C的發布訊息。',
    ],
    [
        'id'   => 'punnode',
        'name' => 'PunNode',
        'img'  => 'punnode.png',
        'url'  => 'http://punnode.com/',
        'desc' => '<p>PunNode，聚焦亞洲科技與創業，親身投入參與、舉辦創業相關聚會及計劃。


        <br><p>報導台灣科技新創公司與國外最新的科技新聞、投資方向以及產業發展趨勢；特別關注以中國、日本、韓國、新加坡…等亞洲科技動態。期許做為國內重要的國際科技媒體代表，搭建起台灣通往世界的橋樑，並冀望協助打造台灣良好的產業鏈與生態系，建立具有台灣特色的開發、創業、科技圈。


        <br><p>與全台最大 App 專業評測網站 最棒app、全台最大科學網站 PanSci 為密切夥伴，同時亦為全球頂尖科技媒體 TechCrunch 中國官方代理方－－動點科技的唯一台灣合作夥伴。',
    ],
    [
        'id'   => 'mofang',
        'name' => 'mofang',
        'img'  => 'mofang.jpg',
        'url'  => 'http://www.mofang.com.tw/',
        'desc' => '魔方網為專業手機遊戲媒體，內容涵蓋手機遊戲新聞、評測、攻略和影片等，並且橫跨PC與行動裝置，提供讀者個性化的趣味內容。'
    ],
    [
        'id'   => 'cool3c',
        'name' => 'cool3c',
        'img'  => 'cool3c.png',
        'url'  => 'http://www.cool3c.com',
        'desc' => '<p>癮科技(<a href="http://www.cool3c.com/">COOL3C.COM</a>)為台灣知名科技媒體網站,2005年由<a href="http://www.funmakr.com/content.php?sno=0000001">博客邦媒體 (FunMakr Media)</a>成立。根據全球數據監測公司 Alexa 測量，癮科技每月有189萬名不重複使用者(UV)。科技新聞媒體網站流量台灣第三。
        <br><br><p>癮科技除了每天有12篇左右的國內外 最新3C產品、APP軟體消息,也與 網友分享許多科技⽣生活新知,另外更 透過許多深度分析、實測觀點的專欄，讓科技更貼近網友們的生活。
        <br><br><p>不僅如此，癮科技現在還致力於回答生活中「為什麼」的問題，例如<a href="http://www.cool3c.com/article/68788">到底什麼是 Prism 法案，對全世界的影響是什麼？</a>還有日常中覺得有點疑惑，卻也沒去思考的數位趣味，例如<a href="http://www.cool3c.com/article/68809">Youtube影片為什麼觀看次數都會留在301次</a>好一陣子這樣的小問題，解開了就會有一種爬上山頂喝上兩口涼水的唱快感呢！
        '
    ],
/*
    [
        'id'   => '',
        'name' => '',
        'img'  => '',
        'url'  => '',
        'desc' => ''
    ],
*/
];

// 輸出畫面
$tpl->content = $tpl->getOutput('media.tpl.php');
$tpl->display('main.tpl.php');



