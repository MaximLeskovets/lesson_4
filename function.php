<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        if ($id != NULL) {
            $url = (string)"https://habrahabr.ru/post/$id";
            $harb = file_get_contents($url);

            if ($harb != false) {

                $title = trim(str_replace("<span>", ' ',
                    strstr(strstr(strstr($harb, '<span class="post__title-arrow">', false),
                        '<span>', false), '</span>', true)));

                $first_string_pre = trim(strip_tags(str_replace("<div class=\"content html_format\">", ' ',
                    strstr(strstr($harb, '<div class="content html_format"', false), "</div", true))));
                $first_string = strstr(strip_tags($first_string_pre), ".", true);

                $time = trim(str_replace("<span class=\"post__time_published\">", ' ',
                    strstr(strstr($harb, '<span class="post__time_published">', false), '</span>', true)));

                $rating = trim(str_replace("Общий рейтинг", ' ',
                    strstr(strstr($harb, "Общий рейтинг", false), ':', true)));

                $view = trim(str_replace('">', ' ', str_replace("Просмотры публикации", ' ',
                    strstr(strstr($harb, "Просмотры публикации", false), '</div>', true))));

                $star = trim(str_replace("публикацию в избранное\">", " ",
                    strstr(strstr($harb, "публикацию в избранное", false), '</span>', true)));
                $value_tag = substr_count($harb, "flag") / 2;


                $harb_array = array(
                    "id" => $id,
                    "title" => $title,
                    "first_string" => $first_string,
                    "time" => $time,
                    "rating" => $rating,
                    "view" => $view,
                    "star" => $star,
                );

                if ($value_tag > 0) {
                    for ($i = 0; $i < $value_tag; $i++) {
                        $result = trim(str_replace(">", " ", strstr(strstr(strstr($harb, 'flag', false), ">", false), "</", true)));
                        $harb_array['tag'] = $result;
                    }
                }


                $json = json_encode($harb_array, JSON_UNESCAPED_UNICODE);
                $json;
            } else {
                $harb_array = array(
                    "status" => "error"
                );
                $json = json_encode($harb_array, JSON_UNESCAPED_UNICODE);
            }
        }
    } else {
        $error  = "Введите ID поста для создания из него json строки";
    }
