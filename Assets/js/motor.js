async function makeFetchFormRequest(method, url, form) {
    const formData = new FormData(form);
 
    try {
      // Realizar la solicitud
      const response = await fetch(url, {
        method: method,
        body: formData,
      });
 
      console.log("Estado de la respuesta HTTP:", response.status);
      console.log("Encabezados de la respuesta:", response.headers);
 
      // Verificar si la respuesta es válida
      if (!response.ok) {
        // Leer como texto en caso de error
        const errorText = await response.text();
        console.error("Error en la respuesta del servidor:", errorText);
        throw new Error(`Error en la respuesta HTTP: ${response.status} ${response.statusText}`);
      }
 
      // Leer y procesar el cuerpo como JSON
      const responseBody = await response.text(); // Leer el cuerpo como texto primero
      try {
        const jsonData = JSON.parse(responseBody); // Intentar parsear como JSON
        console.log("Respuesta JSON recibida:", jsonData);
        return jsonData;
      } catch (jsonParseError) {
        console.error("Error al parsear JSON:", jsonParseError);
        console.error("Contenido bruto de la respuesta:", responseBody);
        throw new Error("La respuesta no contiene JSON válido.");
      }
    } catch (error) {
      console.error("Error capturado durante la petición:", error.message);
      throw error;
    }
}

async function insertarDatos1(form, boton, controlador, contenedor) {
  
  
   // Desactiva el botón para evitar envíos múltiples
 
  try {
      const response = await makeFetchFormRequest("POST", controlador, form);  // Esperamos a que la solicitud se complete
 
      // Verifica si la respuesta es exitosa
      if (response.status === "success") {
          contenedor.textContent = response.message;  // Mostrar mensaje de éxito
          form.reset();  // Limpiar el formulario
          setTimeout(function () {
              window.location.href = "publicacion.php"; // Redirige después de 2 segundos
          }, 2000);
      } else {
          contenedor.textContent = response.message || "Error desconocido.";  // Si la respuesta no es exitosa
      }
  } catch (error) {
      console.error("Error en la inserción:", error.message);  // Muestra el error en la consola
      contenedor.textContent = "Publicación subida con éxito";
  } finally {
    
    // Reactiva el botón
  }
}

function createResponseBlock(item) {
  const bloque0 = document.createElement("div");
  bloque0.classList.add("bloque0");

  // Definir los nombres de los campos
  const fields = {
      imagen: "Imagen",
      titulo: "Título",
      fecha: "Fecha",
      autor: "Autor",
      contenido: "Contenido",
      num_respuestas: "Número de Respuestas"
  };


  Object.keys(fields).forEach(field => {
    const div = document.createElement("div");

    if (field === "imagen") {
        div.classList.add("bloque1");
        const img = document.createElement("img");
        img.src = `${item.imagen}`; 
        img.alt = "Imagen de la publicación";
        img.classList.add("imagen-publicacion");
        div.appendChild(img);
    } else if (field === "contenido") {
        div.classList.add("bloque-contenido"); // Clase especial para diferenciar contenido

        const label = document.createElement("strong");
        label.textContent = `${fields[field]}: `; // Etiqueta en negrita

        const contenidoTexto = document.createElement("p"); 
        contenidoTexto.textContent = item[field]; 
        contenidoTexto.classList.add("contenido-texto"); // Clase para estilizar mejor

        div.appendChild(label);
        div.appendChild(contenidoTexto);
    } else {
        div.classList.add("bloque1");

        const label = document.createElement("strong");
        label.textContent = `${fields[field]} `;

        const span = document.createElement("span");
        span.textContent = " : " + item[field];

        div.appendChild(label);
        div.appendChild(span);
    }

    bloque0.appendChild(div);
});


   const respuestaDiv = document.createElement("div");
    respuestaDiv.classList.add("bloque-respuesta");

    const respuestaLink = document.createElement("a");
    respuestaLink.href = `respuesta.php?id_pub=${item.id_pub}`;
    respuestaLink.textContent = "AÑADIR RESPUESTA";
    respuestaLink.classList.add("link-respuesta");

    respuestaDiv.appendChild(respuestaLink);
    bloque0.appendChild(respuestaDiv);

  return bloque0;
}


 
 
 
document.addEventListener("DOMContentLoaded", function () {
    //alert("hola");
    const formRegistro = document.getElementById("formRegistro");
 
    if (formRegistro) {
        const botonRegistro = document.getElementById("botonRegistro");
        const controller1 = "Controllers/registro_controller.php";
        const resultadoRegistro = document.getElementById("resultadoRegistro");
        formRegistro.addEventListener("submit", function (event) {
            event.preventDefault();
            botonRegistro.disabled = true;
            makeFetchFormRequest('POST', controller1, formRegistro)
                .then(response => {
                    if (response.status === "success") {
                        resultadoRegistro.textContent = response.message;
                        formRegistro.reset();
                    }
                    else {
                        resultadoRegistro.textContent = response.message || 'Error desconocido.';
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción:", error.message);
                    resultadoRegistro.textContent = 'No se pudo realizar la inserción';
                })
                .finally(() => {
                    botonRegistro.disabled = false;
                });
        });
    }

    const formInicia = document.getElementById("formInicia");

    if (formInicia) {
        const botonInicio = document.getElementById("botonInicio");
        const controller1 = "Controllers/login_controller.php";
        const resultadoInicia = document.getElementById("resultadoInicia");


        formInicia.addEventListener("submit", function (event) {
            
            event.preventDefault();
            botonInicio.disabled = true;
            makeFetchFormRequest('POST', controller1, formInicia)
                .then(response => {
                    if (response.status === "success") {
                        resultadoInicia.textContent = response.message;
                        formInicia.reset();
                        window.location.href = "publicacion.php";
                    }
                    else {
                        resultadoInicia.textContent = response.message || 'Error desconocido.';
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción:", error.message);
                    resultadoInicia.textContent = 'No se pudo realizar la inserción';
                })
                .finally(() => {
                    botonInicio.disabled = false;
                });
        });
    }
 

    /* ---------------------------------- al cargar la pagina salen los datos */ 
 
    if (window.location.href.includes("publicacion.php")){
        // y el DOM ha sido completamente cargado...
        addEventListener("DOMContentLoaded", async (event) => {
    
          event.preventDefault();
          
    
          // Paso 1 - Referencia de los elementos 
          const formInsercion2 = document.getElementById("formInsercion2");
    
          if (formInsercion2)
          {
            // Referencia de los elementos
            const button1 = document.getElementById("botonInsercion2");
            const controller1 = "Controllers/insercionConsultaPublicacionController.php";
            const divResponse1 = document.getElementById("contenedor2");
    
            try
            {
              const response1 = await makeFetchFormRequest('POST', controller1, formInsercion2);
              // Limpiar div antes de añadir elementos
              divResponse1.innerHTML = '';
    
              if (response1.length > 0) {
                // Datos (elimina la parte que genera el encabezado)
                response1.forEach(item => {
                    divResponse1.appendChild(createResponseBlock(item));
                });
              }
              else
              {
                divResponse1.textContent = 'No hay datos que coincidan con la búsqueda realizada';
              }
    
              formInsercion2.reset();
            }
            catch (error)
            {
              console.error("Error en la petición:", error.message);
              divResponse1.textContent = 'No se ha realizado la acción';
              formInsercion2.reset();
            }
            finally
            {
              button1.disabled = false;
            }
          }
        }); 
      }
      /* ---------------------------------- FIN - (load) Seleccionar al cargar la página 1 */ 
/*Se carga la publicacion cuando se da click a ella*/
if (window.location.href.includes("respuesta.php")){
        // y el DOM ha sido completamente cargado...
        addEventListener("DOMContentLoaded", async (event) => {
    
          event.preventDefault();
          
    
          // Paso 1 - Referencia de los elementos 
          const formInsercionRespuesta = document.getElementById("formInsercionRespuesta");
    
          if (formInsercionRespuesta)
          {
            // Referencia de los elementos
            const button1 = document.getElementById("botonRespuesta");
            const controller1 = "Controllers/insercionConsultaRespuestaController.php";
            const divResponse1 = document.getElementById("contenedor2");
    
            try
            {
              const response1 = await makeFetchFormRequest('POST', controller1, formInsercion2);
              // Limpiar div antes de añadir elementos
              divResponse1.innerHTML = '';
    
              if (response1.length > 0) {
                // Datos (elimina la parte que genera el encabezado)
                response1.forEach(item => {
                    divResponse1.appendChild(createResponseBlock(item));
                });
              }
              else
              {
                divResponse1.textContent = 'No hay datos que coincidan con la búsqueda realizada';
              }
    
              formInsercion2.reset();
            }
            catch (error)
            {
              console.error("Error en la petición:", error.message);
              divResponse1.textContent = 'No se ha realizado la acción';
              formInsercion2.reset();
            }
            finally
            {
              button1.disabled = false;
            }
          }
        }); 
      }
/*----------------------------------------------------------------------------*/ 

/* ---------------------------------- INICIO - (submit) Insertar y subir archivos 1 */
  // Paso 1: Obtener referencias:
  const formSubidaArchivos = document.getElementById("formSubidaArchivos");
  // Paso 2 - Asociación del elemento al evento (submit) y llamada a la función
  if(formSubidaArchivos)
  {
    // Referencia de los elementos
    boton1 = document.getElementById("botonInsercion1");
    controlador1 = "Controllers/insercionArchivosController.php";
    div1 = document.getElementById("contenedor2");
    // Evento y llamada a la función
    
    formSubidaArchivos.addEventListener("submit", function(event){
      event.preventDefault();
     
      insertarDatos1(formSubidaArchivos,boton1,controlador1,div1);
      console.log("formulario enviado")
    });
  }
  /* ---------------------------------- FIN - (submit) Insertar y subir archivos 1  */


});