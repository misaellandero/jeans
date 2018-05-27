<form id="registro-producto" class="col-md-12" action="registro.php" method="POST" enctype="multipart/form-data" >
  <div class="row">

<div class="form-group col-md-6 col-sm-12">
  <h4>Datos del producto</h4>
      <label>Clave Principal</label>
        <input class="form-control"  id="Id" name="Id"  type="int(11)" maxlength="13" required disabled/>
        <input class="form-control"  id="id-hidden" name="id-hidden"  type="hidden" maxlength="13"/>
        <input class="form-control"  id="id-sugerido" name="id-sugerido"  type="hidden" maxlength="13"/>



          <label> Producto</label>
              <select class="form-control" id="producto" name="producto" type="text" required/>
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


  <label> Tipo</label>
        <select class="form-control" id="tipo" name="tipo" type="text" required/>
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

        <label> Modelo </label>
        <select class="form-control" id="Descripcion"  name="Descripcion" type="text" required/>
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

   <label> Talla</label>
        <select class="form-control" id="talla"  name="talla" type="text" required/>
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

<label>Tela</label>
        <select class="form-control"id="tela"  name="tela" type="text" required/>
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

      <label>Serie</label>
             <input class="form-control"  id="Corte" name="Corte"  type="int(2)" maxlength="2" required readonly/><p>
<label> Unidad</label>
        <select class="form-control"id="unidad-registro" name="Unidad" type="text" required/>
       <option>Docena</option>

</select>
</div>
<?php include('upload.php'); ?>
