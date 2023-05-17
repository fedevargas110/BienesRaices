<?php
    include './includes/templates/header.php';
    require 'includes/app.php';
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" placeholder="Tu Nombre">

                <label for="email">E-mail: </label>
                <input type="email" id="email" placeholder="Mail">

                <label for="telefono">Telefono: </label>
                <input type="tel" id="telefono" placeholder="Telefono Celular">

                <label for="mensaje">Mensaje: </label>
                <textarea id="mensaje" placeholder="Dejanos tu Mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacíon sobre la Propiedad</legend>

                <label for="opciones">Vende o Compra: </label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="vende">Vende</option>
                    <option value="compra">Compra</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto: </label>
                <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto">

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado:</p>
                <div class="forma-contactar">
                    <label for="contactar-telefono">Teléfono </label>
                    <input name="contacto" type="radio" id="contactar-telefono" value="telefono">

                    <label for="contactar-email">E-Mail </label>
                    <input name="contacto" type="radio" id="contactar-email" value="email">
                </div>

                <p>Sí eligío teléfono, indique fecha y hora</p>

                <label for="fecha">Fecha: </label>
                <input type="date" id="fecha">

                <label for="hora">Hora: </label>
                <input type="time" id="hora" min="08:00" max="21:00">
            </fieldset>

            <input type="submit" class="boton-verde" value="Enviar">
        </form>
    </main>

<?php 
    include './includes/templates/footer.php';
?>