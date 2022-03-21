<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (!function_exists('cetak')) {
  function cetak($str)
  {
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}

if (!function_exists('cek_token')) {
}

if (!function_exists('public_upload')) {
  function public_upload($file, $field, $folder)
  {
    $config['upload_path'] = './assets/uploads/' . $folder . '/'; //path folder
    $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = true; //Enkripsi nama yang terupload
    $CI = get_instance();
    $CI->load->library('upload');
    $CI->upload->initialize($config);
    if (!empty($file['name'])) {
      $uploadPath = $config['upload_path'];
      if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 07777, true);
      }
      if ($CI->upload->do_upload($field)) {
        $gbr = $CI->upload->data();
        //Compress Image
        $config['image_library'] = 'gd2';
        $config['source_image'] = './media/' . $folder . '/' . $gbr['file_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['quality'] = '50%';
        // $config['width'] = 600;
        // $config['height'] = 400;
        $config['new_image'] = './media/' . $folder . '/' . $gbr['file_name'];
        $CI->load->library('image_lib', $config);
        $CI->image_lib->resize();
        $gambar = $gbr['file_name'];
        return $gambar;
      } else {
        print_r($CI->upload->display_errors());
        die();
      }
    } else {
      return false;
    }
  }
}

if (!function_exists('upload_image')) {
  function upload_image($file, $field, $folder)
  {
    $config['upload_path'] = './media/' . $folder . '/'; //path folder
    $config['allowed_types'] = 'jpg|png|jpeg|svg'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = true; //Enkripsi nama yang terupload
    $CI = get_instance();
    $CI->load->library('upload');
    $CI->upload->initialize($config);
    if (!empty($file['name'])) {
      $uploadPath = $config['upload_path'];
      if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 07777, true);
      }
      if ($CI->upload->do_upload($field)) {
        $gbr = $CI->upload->data();
        //Compress Image
        $config['image_library'] = 'gd2';
        $config['source_image'] = './media/' . $folder . '/' . $gbr['file_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['quality'] = '50%';
        // $config['width'] = 600;
        // $config['height'] = 400;
        $config['new_image'] = './media/' . $folder . '/' . $gbr['file_name'];
        $CI->load->library('image_lib', $config);
        $CI->image_lib->resize();
        $gambar = $gbr['file_name'];
        return $gambar;
      } else {
        print_r($CI->upload->display_errors());
        die();
      }
    } else {
      return false;
    }
  }
}

if (!function_exists('upload')) {
  function upload_audio($file, $field, $folder, $type)
  {
    $config['upload_path'] = './media/' . $folder . '/'; //path folder
    $config['allowed_types'] = $type; //type yang dapat diakses bisa anda sesuaikan
    // $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $CI = get_instance();
    $CI->load->library('upload');
    $CI->upload->initialize($config);
    if (!empty($file['name'])) {
      $uploadPath = $config['upload_path'];
      if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 07777, true);
      }
      if ($CI->upload->do_upload($field)) {
        $gbr = $CI->upload->data();
        //Compress Image
        $config['image_library'] = 'gd2';
        $config['source_image'] = './media/' . $folder . '/' . $gbr['file_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['quality'] = '50%';
        // $config['width'] = 600;
        // $config['height'] = 400;
        $config['new_image'] = './media/' . $folder . '/' . $gbr['file_name'];
        $CI->load->library('image_lib', $config);
        $CI->image_lib->resize();
        $gambar = $gbr['file_name'];
        return $gambar;
      } else {
        print_r($CI->upload->display_errors());
        die();
      }
    } else {
      return false;
    }
  }
}

if (!function_exists('send_mail')) {
  function send_mail($to_email, $subject, $temp)
  {
    $config = array();
    $config['charset'] = 'utf-8';
    $config['useragent'] = 'Codeigniter';
    $config['protocol'] = "mail";
    $config['mailtype'] = "html";
    $config['smtp_host'] = 'mail.ayem.basaraga.com';
    $config['smtp_port'] = 465;
    $config['smtp_timeout'] = 400;
    $config['smtp_user'] = 'info@ayem.basaraga.com';
    $config['smtp_pass'] = '7[*6OLc]a08S';
    $CI = get_instance();
    $CI->load->library('email');
    $CI->email->initialize($config);
    $CI->email->set_newline("\r\n");
    $CI->email->from('reset@ayem.basaraga.com', 'Reset Password');
    $CI->email->to($to_email);
    $CI->email->subject($subject);
    $CI->email->message($temp);

    if ($CI->email->send()) {
      return true;
    } else {
      return $CI->email->print_debugger();
    }
  }
}

if (!function_exists('encode_arr')) {
  function encode_arr($data)
  {
    return encrypt_url(serialize($data));
    // return base64_encode(serialize($data));
  }
}

if (!function_exists('decode_arr')) {
  function decode_arr($data)
  {
    return unserialize(decrypt_url($data));
    // return unserialize(base64_decode($data));
  }
}

function new_encrypt_url($string, $secret_key)
{

  $output = false;
  /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */
  $security       = parse_ini_file("security.ini");
  // $secret_key     = $security["encryption_key"];
  $secret_iv      = $security["iv"];
  $encrypt_method = $security["encryption_mechanism"];

  // hash
  $key    = hash("sha256", $secret_key);

  // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
  $iv     = substr(hash("sha256", $secret_iv), 0, 16);

  //do the encryption given text/string/number
  $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
  $output = base64_encode($result);
  return $output;
}

function new_decrypt_url($string, $secret_key)
{

  $output = false;
  /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

  $security       = parse_ini_file("security.ini");
  // $secret_key     = $security["encryption_key"];
  $secret_iv      = $security["iv"];
  $encrypt_method = $security["encryption_mechanism"];

  // hash
  $key    = hash("sha256", $secret_key);

  // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
  $iv = substr(hash("sha256", $secret_iv), 0, 16);

  //do the decryption given text/string/number

  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  return $output;
}


function hariIndo($hariInggris)
{
  switch ($hariInggris) {
    case 'Sunday':
      return 'Minggu';
    case 'Monday':
      return 'Senin';
    case 'Tuesday':
      return 'Selasa';
    case 'Wednesday':
      return 'Rabu';
    case 'Thursday':
      return 'Kamis';
    case 'Friday':
      return 'Jumat';
    case 'Saturday':
      return 'Sabtu';
    default:
      return 'hari tidak valid';
  }
}

function bulanIndo($bulanInggris)
{
  switch ($bulanInggris) {
    case 'January':
      return 'Januari';
    case 'February':
      return 'Februari';
    case 'March':
      return 'Maret';
    case 'April':
      return 'April';
    case 'May':
      return 'Mei';
    case 'June':
      return 'Juni';
    case 'July':
      return 'Juli';
    case 'August':
      return 'Agustus';
    case 'September':
      return 'September';
    case 'October':
      return 'Oktober';
    case 'November':
      return 'November';
    case 'December':
      return 'Desember';
    default:
      return 'bulan tidak valid';
  }
}

function tanggal_mingguan($tanggal)
{
  $day_of_week = date('N', strtotime($tanggal));
  $given_date = strtotime($tanggal);
  $first_of_week =  date('Y-m-d', strtotime("- {$day_of_week} day", $given_date));
  $first_of_week = strtotime($first_of_week);
  for ($i = 1; $i <= 7; $i++) {
    $week_array[] = date('Y-m-d', strtotime("+ {$i} day", $first_of_week));
  }
  return $week_array;
}


if (!function_exists('closeTags')) {
  function closeTags($string)
  {
    // coded by Constantin Gross <connum at googlemail dot com> / 3rd of June, 2006
    // (Tiny little change by Sarre a.k.a. Thijsvdv)
    $donotclose = array('br', 'img', 'input'); //Tags that are not to be closed

    //prepare vars and arrays
    $tagstoclose = '';
    $tags = array();

    //put all opened tags into an array  /<(([A-Z]|[a-z]).*)(( )|(>))/isU
    preg_match_all("/<(([A-Z]|[a-z]).*)(( )|(>))/isU", $string, $result);
    $openedtags = $result[1];
    // Next line escaped by Sarre, otherwise the order will be wrong
    // $openedtags=array_reverse($openedtags);

    //put all closed tags into an array
    preg_match_all("/<\/(([A-Z]|[a-z]).*)(( )|(>))/isU", $string, $result2);
    $closedtags = $result2[1];

    //look up which tags still have to be closed and put them in an array
    for ($i = 0; $i < count($openedtags); $i++) {
      if (in_array($openedtags[$i], $closedtags)) {
        unset($closedtags[array_search($openedtags[$i], $closedtags)]);
      } else array_push($tags, $openedtags[$i]);
    }

    $tags = array_reverse($tags); //now this reversion is done again for a better order of close-tags

    //prepare the close-tags for output
    for ($x = 0; $x < count($tags); $x++) {
      $add = strtolower(trim($tags[$x]));
      if (!in_array($add, $donotclose)) $tagstoclose .= '</' . $add . '>';
    }

    //and finally
    return $string . $tagstoclose;
  }
}

if (!function_exists('myword_limiter')) {
  function myword_limiter($str, $n = 100, $end_char = '…')
  {
    if (strlen($str) < $n) {
      return closeTags($str);
    }
    $words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));

    if (count($words) <= $n) {
      return closeTags($str);
    }

    $str = '';
    for ($i = 0; $i < $n; $i++) {
      $str .= $words[$i] . ' ';
    }
    $str = closeTags($str);
    return trim($str) . $end_char;
  }

  function dd($data)
  {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
  }

  function umur($tgl_lahir)
  {
    // ubah ke format Ke Date Time
    $lahir = new DateTime($tgl_lahir);
    $hari_ini = new DateTime();
    $diff = $hari_ini->diff($lahir);
    return $diff;
  }

  function covtime($youtube_time)
  {
    preg_match_all('/(\d+)/', $youtube_time, $parts);

    // Put in zeros if we have less than 3 numbers.
    if (count($parts[0]) == 1) {
      array_unshift($parts[0], "0", "0");
    } elseif (count($parts[0]) == 2) {
      array_unshift($parts[0], "0");
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init % 60;
    $seconds_overflow = floor($sec_init / 60);

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ($min_init) % 60;
    $minutes_overflow = floor(($min_init) / 60);

    $hours = $parts[0][0] + $minutes_overflow;

    if ($hours != 0)
      return $hours . ':' . $minutes . ':' . $seconds;
    else
      return $minutes . ':' . $seconds;
  }
}

function encrypt_img($user, $signature, $image_path)
{
  // $image_path = 'gambar.jpg'; //this will be the physical path of your image

  $img_binary = fread(fopen($image_path, "r"), filesize($image_path));

  // $img_str = base64_encode($img_binary); // will produce the encoded string
  $img_str = new_encrypt_url($img_binary, $signature);
  $book_name =  $user . "-" . date('dmYHis') . ".txt";

  $myfile = fopen(BUKU_HARIANKU . $book_name, "w");
  fwrite($myfile, $img_str);
  fclose($myfile);

  return $book_name;
}

function decrypt_img($signature, $image_file)
{
  $myfile = fopen(BUKU_HARIANKU . $image_file, "r");
  $isinya =  fgets($myfile);
  fclose($myfile);

  $decoded_str = new_decrypt_url($isinya, $signature); //pass the encoded string here

  $im = imagecreatefromstring($decoded_str);
  //below code will display the image on browser
  if ($im !== false) {
    header('Content-Type: image/gif');
    imagegif($im);
    imagedestroy($im);
  } else {
    echo 'An error occurred.';
  }
}

function tgl_indo($tanggal)
{
  $bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);

  return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function rupiah($nominal)
{
  return 'Rp. <span style="text-align:right;">' . number_format($nominal, 0, ',', '.') . '</span>';
}

function cek_jwt()
{
  $CI = get_instance();
  try {
    JWT::decode($CI->session->userdata('token'), new Key(PUBLIC_KEY_JWT, 'HS256'));
  } catch (\Throwable $th) {
    redirect('auth');
  }
}

function jwt(){
  $CI = get_instance();
  return JWT::decode($CI->session->userdata('token'), new Key(PUBLIC_KEY_JWT, 'HS256'));
}
