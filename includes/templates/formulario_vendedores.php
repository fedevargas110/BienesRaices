<fieldset>
<legend>Información General</legend>

<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="vendedores[nombre]" placeholder="Nombre de Vendedor(a)" value="<?php echo s($vendedor->nombre) ?>">

<label for="apellido">Apellido:</label>
<input type="text" id="nombre" name="vendedores[apellido]" placeholder="Apellido de Vendedor(a)" value="<?php echo s($vendedor->apellido) ?>">

</fieldset>

<fieldset>
<legend>Información Extra</legend>

<label for="telefono">Telefonoo:</label>
<input type="text" id="telefono" name="vendedores[telefono]" placeholder="Telefono de Vendedor(a)" value="<?php echo s($vendedor->telefono) ?>">

</fieldset>