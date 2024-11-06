<?php
/**
 * @description: Kelas ini merupakan kelas untuk inisialisasi awal pada folder public yang dipanggil oleh index.php
 */

namespace Uniga\Ppdb\core;

class App
{
  protected $controller = 'Home';
  protected $method = 'index';
  protected $params = [];

  //Constructor untuk class app
  public function __construct(){

      //Pengambilan isi url 
      //$url[0] = controller
      //$url[1] = method
      //$url[2] = params

      $url = $this->parse_url();                                                    //ambil isi url hasil dari function parse_url

      if (file_exists(ROOT . '/src/controllers/' . $url[0] . '.php')) {
          $this->controller = ucfirst($url[0]);                                     //Atur controller sesuai dengan $url[0]
          unset($url[0]);                                                           //Hapus array $url[0]
      }

      //Controller URL
      //memuat file controller yang sesuai
      require_once ROOT . '/src/controllers/' . $this->controller . '.php';
      $controllerClass = "\\Uniga\\Ppdb\\controllers\\" . $this->controller;        //buat variable obect yang sesuai dengan controller
      $this->controller = new $controllerClass();                                   //membuat objek baru dari class yang sesuai dengan controller
      //var_dump($this->controller);

      //method URL
      //Memanggil method yang sesuai yang terdapat pada controller
      if (isset($url[1])){
        if (method_exists($this->controller, $url[1])){
          $this->method = $url[1];                                                  //variable $method diisi dengan $url[1]
          unset($url[1]);                                                           //hapus array $url[1] -> index ke-1
        }
      }
  }

  //Method untuk melewatkan parameter url (?url=...) atau
  //apapun yang dilewatkan setelah folder yang ada dipanggil
  public function parse_url(){
    //check apakah $_GET[url] ada atau tidak
    if (isset($_GET['url'])){
      $url = $_GET['url'];                                                          //isi variabel $url dengan apapun yang dilewatkan melalui $_GRT['url']
      $url = rtrim($_GET['url'], '/');                                              //hilangkan tanda '/' pada bagian akhir url
      $url = filter_var($url, FILTER_SANITIZE_URL);                                 //filter url parameter agar tidak ada karakter terlarang pada url
      $url = explode("/", $url);                                                    //pecah isi url menjadi array
      return $url;                                                                  //nilai pengembalian fungsi ini adalah array
    }
  }
}
