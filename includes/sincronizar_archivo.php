<?php
   $ftp_user_name= "u315449203";
   $ftp_user_pass= "UTkFYCS7xtPK";

   $file = ($_GET['img']);
   $ruta_local = "../files/fotos_modelos/$file";//tobe uploaded
   $ruta_remota = "jeans/files/fotos_modelos/$file";


   // set up basic connection
   $conn_id = ftp_connect("ftp.ceyeme.mx");

   // login with username and password
   $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

   // upload a file
   if (ftp_put($conn_id,  $ruta_remota, $ruta_local, FTP_ASCII)) {
       echo "La imagen se ha sudio al servidor $file";
       exit;
   } else {
       echo "Hubo un error con $file la conexión se corto";
       exit;
       }
   // close the connection
   ftp_close($conn_id);
 ?>
