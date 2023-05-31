<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Nombre:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Nombre de la Propiedad" value="<?php echo s($propiedad->titulo) ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo s($propiedad->precio) ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <?php if($propiedad->imagen) { ?>
                    <img src="../../imagenes/<?php echo $propiedad->imagen ?>" alt="imagen propiedad" class="imagen-small">
                <?php } ?>    

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion) ?></textarea>
            </fieldset>
              
            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones) ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc) ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento) ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
            </fieldset>
