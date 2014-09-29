<?php

class IndexController extends ProtectedController {

    public function __construct()
    {
        parent::__construct();        
    }
    
    public function getIndex()
    {        
        $user = User::find(Auth::user()->id);
        $role = $user->role()->get()->first();
        if($role->nombre != "ADMINISTRADOR" && $role->nombre != "INTERNO")
        {
            $menu = $role->menus()->get()->first();
            $direccion = '/paginas/' . $menu->id;
            return Redirect::to($direccion)->with('user', serialize($user))->with('role', serialize($role));
        }
        $menus = Menu::all();
        return View::make('index')->with('menus', $menus);
    }       
    
    public function postCarga() {
        $allowedExts = array(
            "gif", "jpeg", "jpg", "png", "ppt", 
            "pptx", "doc", "docx", "pdf", "xls", 
            "xlsx", 'zip', 'PDF');
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        $menu_array = $_POST["menu_id"];
        $menu_plano = implode($menu_array);

        if ($_FILES["file"]["type"] != "" && $_FILES["file"]["type"] != NULL && in_array($extension, $allowedExts)) {
          if ($_FILES["file"]["error"] > 0) {
            echo "Código de error: " . $_FILES["file"]["error"] . "<br />";
          } else {
            $nombreArchivo = ($_POST["nombreArchivo"] == '')? $_FILES["file"]["name"] : $_POST["nombreArchivo"]  . '.' .$extension;
            //$nombreArchivo = iconv('UTF-8','ASCII//TRANSLIT//IGNORE',$nombreArchivo); 
            echo "Archivo cargado: " . $nombreArchivo . "<br>";
            echo "Tipo: " . $_FILES["file"]["type"] . "<br>";
            echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";    
            //$fk_menu = $_POST['fk_menu'];
            if (file_exists("uploads/" . $nombreArchivo)) {
                echo '<p style="color:red;">Estatus: Error </p>';
                echo $nombreArchivo . " ya existe. ";
            } else {  
                echo '<p style="color:green;">Estatus: OK </p>';
                Input::file('file')->move(storage_path() . '/uploads/', $nombreArchivo);
                //move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__. "/storage/uploads/" . $nombreArchivo);
                foreach ($menu_array as $menu) {
                    $file = new FileApisa;
                    $file->nombre = $nombreArchivo;
                    $file->descripcion = $_POST["descripcionArchivo"];
                    $file->estatus = '1';
                    $file->content_type = Input::file('file')->getClientMimeType();
                    $file->menu_id = $menu;                    
                    $file->save();
                }

                echo "Almacenado en: " . storage_path() . '/uploads/' . $nombreArchivo . '<br />';
                //echo $test2;      
            }
          }
        } else {
            echo '<p style="color:red;">Estatus: Error </p>';
            echo "Archivo no válido";
        }
    }
    
}
?>