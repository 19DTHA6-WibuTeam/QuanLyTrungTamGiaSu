<?php
class cURL
{
  var $headers;
  var $user_agent;
  var $compression;
  var $cookie_file;
  var $proxy;

  function __construct($cookies = TRUE, $cookie = 'cook.txt', $compression = 'gzip', $proxy = '')
  {
    $this->headers[] = 'Accept: */*';
    $this->headers[] = 'Connection: Keep-Alive';
    $this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
    $this->user_agent = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
    $this->compression = $compression;
    $this->proxy = $proxy;
    $this->cookies = $cookies;
    if ($this->cookies == TRUE) $this->cookie($cookie);
  }

  function cookie($cookie_file)
  {
    if (file_exists($cookie_file)) {
      $this->cookie_file = $cookie_file;
    } else {
      fopen($cookie_file, 'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
      $this->cookie_file = $cookie_file;
      fclose($this->cookie_file);
    }
  }

  function setheader($data)
  {
    $this->headers = array_merge($this->headers, $data);
  }

  function getheader($url)
  {
    $process = curl_init($url);
    curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
    curl_setopt($process, CURLOPT_HEADER, 1);
    curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
    if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
    if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
    curl_setopt($process, CURLOPT_ENCODING, $this->compression);
    curl_setopt($process, CURLOPT_TIMEOUT, 30);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($process, CURLOPT_CAINFO, NULL);
    curl_setopt($process, CURLOPT_CAPATH, NULL);
    $return = curl_exec($process);
    curl_close($process);
    return $return;
  }

  function contenttype($data)
  {
    foreach ($this->headers as $k => $v) {
      if (strpos($v, 'Content-type:') !== false) {
        $this->headers[$k] = 'Content-type: ' . $data;
        break;
      }
    }
  }

  function get($url)
  {
    $process = curl_init($url);
    curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
    curl_setopt($process, CURLOPT_HEADER, 0);
    curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
    if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
    if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
    curl_setopt($process, CURLOPT_ENCODING, $this->compression);
    curl_setopt($process, CURLOPT_TIMEOUT, 30);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($process, CURLOPT_CAINFO, NULL);
    curl_setopt($process, CURLOPT_CAPATH, NULL);
    $return = curl_exec($process);
    curl_close($process);
    return $return;
  }

  function post($url, $data, $method = null)
  {
    $process = curl_init($url);
    curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
    curl_setopt($process, CURLOPT_HEADER, 0);
    curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
    if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
    if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
    curl_setopt($process, CURLOPT_ENCODING, $this->compression);
    curl_setopt($process, CURLOPT_TIMEOUT, 0);
    curl_setopt($process, CURLOPT_POSTFIELDS, $data);
    if ($method) curl_setopt($process, CURLOPT_CUSTOMREQUEST, $method);
    else curl_setopt($process, CURLOPT_POST, 1);
    curl_setopt($process, CURLOPT_MAXREDIRS, 10);
    curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($process, CURLOPT_CAINFO, NULL);
    curl_setopt($process, CURLOPT_CAPATH, NULL);
    $return = curl_exec($process);
    curl_close($process);
    return $return;
  }

  function error($error)
  {
    echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
    die;
  }
}

class Admin
{
  var $curl;

  function __construct()
  {
    $this->curl = new cURL(false);
    if (getSESSION('admin_token')) $this->curl->setheader(['Authorization: Bearer ' . getSESSION('admin_token')]);
  }

  public function login($passwordAdmin, $body)
  {
    if ($passwordAdmin == ADMIN_PASSWORD)
      return $this->curl->post(API_URL . '/NguoiDung/login', $body);
    else return json_encode(array('success' => false, 'message' => 'Mật khẩu Admin không chính xác!'));
  }

  public function startSession($data)
  {
    $_SESSION['admin'] = true;
    $_SESSION['admin_token'] = $data['token'];
  }

  public static function endSession()
  {
    unset($_SESSION['admin']);
    unset($_SESSION['admin_token']);
  }

  public function checkSession()
  {
    $a = $this->curl->get(API_URL . '/NguoiDung/check-session');
    $a = json_decode($a, true);
    if ($a['success'] == true) return true;
    else false;
  }
}

class NguoiDung
{
  var $curl;

  function __construct()
  {
    $this->curl = new cURL(false);
    if (getSESSION('token')) $this->curl->setheader(['Authorization: Bearer ' . getSESSION('token')]);
  }

  public function startSession($data)
  {
    $_SESSION['MaNguoiDung'] = $data['MaNguoiDung'];
    $_SESSION['HoTen'] = $data['HoTen'];
    $_SESSION['Avatar'] = $data['Avatar'];
    $_SESSION['LaGiaSu'] = $data['LaGiaSu'];
    $_SESSION['token'] = $data['token'];
  }

  public function updateSession($data)
  {
    if ($data['HoTen']) $_SESSION['HoTen'] = $data['HoTen'];
    if ($data['Avatar']) $_SESSION['Avatar'] = $data['Avatar'];
    if ($data['LaGiaSu']) $_SESSION['LaGiaSu'] = $data['LaGiaSu'];
    if ($data['token']) $_SESSION['token'] = $data['token'];
  }

  public function endSession()
  {
    // session_destroy();
    unset($_SESSION['MaNguoiDung']);
    unset($_SESSION['HoTen']);
    unset($_SESSION['Avatar']);
    unset($_SESSION['LaGiaSu']);
    unset($_SESSION['token']);
  }

  public function checkSession()
  {
    $a = $this->curl->get(API_URL . '/NguoiDung/check-session');
    $a = json_decode($a, true);
    if ($a['success'] == true) return true;
    else false;
  }

  public function login($body)
  {
    return $this->curl->post(API_URL . '/NguoiDung/login', $body);
  }

  public function register($body)
  {
    return $this->curl->post(API_URL . '/NguoiDung/register', $body);
  }

  public function getProfile($MaNguoiDung)
  {
    return $this->curl->get(API_URL . '/NguoiDung/' . $MaNguoiDung);
  }

  public function updateProfile($MaNguoiDung, $body)
  {
    $this->curl->contenttype('multipart/form-data');
    return $this->curl->post(API_URL . '/NguoiDung/' . $MaNguoiDung, $body, 'PATCH');
  }

  public function DoiMatKhau($body)
  {
    return $this->curl->post(API_URL . '/NguoiDung/DoiMatKhau', $body);
  }
}

class KhoaHoc
{
  var $curl;

  function __construct()
  {
    $this->curl = new cURL(false);
    if (getSESSION('token')) $this->curl->setheader(['Authorization: Bearer ' . getSESSION('token')]);
  }

  public function getThongTinDangKy()
  {
    return $this->curl->get(API_URL . '/ThongTinDangKy');
  }

  public function getKhoaHocById($MaKhoaHoc)
  {
    return $this->curl->get(API_URL . '/KhoaHoc/' . $MaKhoaHoc);
  }

  public function getKhoaHocByKeyValue($k, $v)
  {
    return $this->curl->get(API_URL . '/KhoaHoc?k=' . $k . '&v=' . $v);
  }

  public function postKhoaHoc($body)
  {
    return $this->curl->post(API_URL . '/KhoaHoc', $body);
  }

  public function updateKhoaHoc($MaKhoaHoc, $body)
  {
    return $this->curl->post(API_URL . '/KhoaHoc/' . $MaKhoaHoc, $body, 'PATCH');
  }

  public function getKhoaHocTKB($k, $v)
  {
    return $this->curl->get(API_URL . '/ThoiKhoaBieu/KhoaHoc?k=' . $k . '&v=' . $v);
  }

  public function getThoiKhoaBieu($k, $v)
  {
    return $this->curl->get(API_URL . '/ThoiKhoaBieu?k=' . $k . '&v=' . $v);
  }
}
