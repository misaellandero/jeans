<?php
 
?>

<form id="registro-producto" action="registro.php" method="POST" enctype="multipart/form-data" >

      <label>Clave Principal</label><p>
        <input id="Id" name="Id"  type="int(11)" maxlength="13" required disabled/>
        <input id="id-hidden" name="id-hidden"  type="hidden" maxlength="13"/>

        <input id="id-sugerido" name="id-sugerido"  type="hidden" maxlength="13"/>
<p>

  <label> Producto</label><p>
        <select id="producto" name="producto" type="text" required/>
<?php
$sql="SELECT * FROM producto ";
$rec=mysql_query($sql);
while($row=mysql_fetch_array($rec))
{
	echo "<option val='".$row["Id"]."'>";
	echo $row['Descripcion'];
	echo "</option>";
}
?>
</select>
 <p>

  <label> Tipo</label><p>
        <select  id="tipo" name="tipo" type="text" required/>
<?php
$sql="SELECT * FROM tipo ";
$rec=mysql_query($sql);
while($row=mysql_fetch_array($rec))
{
	echo "<option val='".$row["Id"]."'>";
	echo $row['Descripcion'];
	echo "</option>";
}
?>
</select>
 <p>
        <label> Modelo </label><p>
        <select  id="Descripcion"  name="Descripcion" type="text" required/>
<?php
$sql="SELECT * FROM modelo ";
$rec=mysql_query($sql);
while($row=mysql_fetch_array($rec))
{
	echo "<option val='".$row["Id"]."'>";
	echo $row['descripsion'];
	echo "</option>";
}
?>
</select>
      <p>
   <label> Talla</label><p>
        <select  id="talla"  name="talla" type="text" required/>
<?php
$sql="SELECT * FROM talla ";
$rec=mysql_query($sql);
while($row=mysql_fetch_array($rec))
{
	echo "<option val='".$row["Id"]."'>";
	echo $row['Descripcion'];
	echo "</option>";
}
?>
</select>
 <p>
<label>Tela</label><p>
        <select id="tela"  name="tela" type="text" required/>
<?php
$sql="SELECT * FROM tela ";
$rec=mysql_query($sql);
while($row=mysql_fetch_array($rec))
{
	echo "<option val='".$row["Id"]."'>";
	echo $row['Descripcion'];
	echo "</option>";
}
?>
</select>
     <p>
      <label>Numero Consecutivo</label><p>
             <input id="Corte" name="Corte"  type="int(2)" maxlength="2" required readonly/><p>
<label> Unidad</label><p>
        <select id="unidad-registro" name="Unidad" type="text" required/>
       <option>Docena</option>

</select><?php include('upload.php'); ?>
