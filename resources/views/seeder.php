<?php

//settings
DB::table('settings')->insert(    [
    ["id" => "1","sitename_ar" => "goodfood","sitename_en" => "goodfood","logo" => "","icon" => "","email" => "eman@example.com","main_lang" => "ar","description" => "موقع لعرض المنتجات","keywords" => "معارض, اجهزه , معدات","status" => "open","message_maintenance" => "الموقع في حاله صيانه","created_at" => "","updated_at" => "2020-10-31 13:24:33",],
    ["id" => "2","sitename_ar" => "goodfood","sitename_en" => "goodfood","logo" => "","icon" => "","email" => "eman@example.com","main_lang" => "ar","description" => "موقع لعرض المنتجات","keywords" => "معارض, اجهزه , معدات","status" => "open","message_maintenance" => "الموقع في حاله صيانه","created_at" => "","updated_at" => "2020-10-31 13:24:33",],
]);
DB::statement("ALTER SEQUENCE settings_id_seq RESTART WITH 3");
//admins
DB::table('admins')->insert(    [
    ["id" => "1","name" => "Eman Hamdy","email" => "eman@example.com","password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi","remember_token" => "VI4zhr8jgi","created_at" => "2020-10-30 18:03:19","updated_at" => "2020-10-30 18:03:19",],
  
]);
DB::statement("ALTER SEQUENCE admins_id_seq RESTART WITH 12");unlink(__FILE__);
?>