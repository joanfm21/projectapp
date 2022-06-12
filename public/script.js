const { forEach } = require("lodash");

/******Formulario popup********/
function abrir_formulario(){
const popup = document.querySelector('.popup-wrapper');
const cerrarPopup = document.querySelectorAll('.popup-close');
const click = document.querySelectorAll('.añadir_mas');
click.forEach(btns =>{
    btns.addEventListener('click', () => {
        console.log('hola');
        popup.style.display = "block";
    });

});

cerrarPopup.forEach(btnCerrarP =>{
       
btnCerrarP.addEventListener('click', () => {
    popup.style.display = 'none';
}); 
});

popup.addEventListener('click', e => {
     
    if(e.target.className === 'popup-wrapper') {
        popup.style.display = 'none';
    }
});
}
/*************************************** */
abrir_formulario();

/**********Borrar registro**************/
function confirmacion_borrar(e){
if (confirm('¿Deseas eliminar este registro?')){

    return true;
}
else{
    e.preventDefault();
}

}

document.querySelectorAll('.borrar_registro').forEach(elementos => {
    elementos.addEventListener('click',(e) =>{
        confirmacion_borrar(e);
      
    });
    });
/*************************************/
/****************Actualizar registros***************************/
    function actualizar_alumnos(id,ciclos){
        let evento = window.event;
        let mostrar = evento.target.closest('.listado_alumno');
        mostrar.style.display="none";
        let tbody = document.querySelector('.tbody_mostrar');
        let newTr = document.createElement('tr');
        let newSelectCiclos = document.createElement('select');
        newSelectCiclos.classList.add('custom-select','select_ciclo_almno');
        newSelectCiclos.setAttribute('name','select_ciclo_almno')
        newTr.classList.add('.update_alumnos');
        newTr.innerHTML = `<td><textarea title="Introduce el nuevo Dni" type="text" class="form-control py-2 my-2 alumno_dni up_alumno" name="alumno_dni"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo nombre" type="text" class="form-control py-2 my-2 ml-1 alumno_nombre up_alumno" name="alumno_nombre"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo apellido" type="text" class="form-control py-2 my-2 ml-1 alumno_apellido up_alumno" name="alumno_apellido"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce la nueva dirección" type="text" class="form-control py-2 my-2 ml-3 alumno_direc up_alumno" name="alumno_direc"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo teléfono" type="text" class="form-control py-2 my-2 ml-2 alumno_telef up_alumno" name="alumno_telef"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo código postal" type="text" class="form-control py-2 my-2 alumno_cp up_alumno" name="alumno_cp"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce la nueva fecha de nacimiento" type="text" class="form-control py-2 my-2 ml-4 alumno_fn up_alumno" name="alumno_fn"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo correo" type="text" class="form-control py-2 my-2 alumno_correo up_alumno" name="alumno_correo"  style="width: 6rem;"></textarea></td>
        <td><input hidden value="${id}" name="actualizar_alumno"></td>
        <td><button type="submit" class="btnGuardar btn btn-primary my-2 py-2" id="btnGuardarA" name="btnGuardar" value="Guardar">Guardar</button></td>`;
        ciclos.forEach(element => {
            newSelectCiclos.innerHTML += `<td><option value="${element.id}">${element.ciclo}</option></td>`;
            newTr.appendChild(newSelectCiclos);
        });
        tbody.appendChild(newTr);
        evento.preventDefault();
    }
    function actualizar_profesores(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.listado_profe');
        mostrar.style.display="none";
        let tbody = document.querySelector('.tbody_mostrar');
        let newTr = document.createElement('tr');
        newTr.classList.add('.update_profes');
        newTr.innerHTML = `<td><textarea title="Introduce el nuevo nombre" type="text" class="form-control py-2 my-2 profe_nombre" name="profe_nombre"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo apellido" type="text" class="form-control py-2 my-2 ml-1 profe_apellido" name="profe_apellido"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo correo" type="text" class="form-control py-2 my-2 profe_correo" name="profe_correo"  style="width: 6rem;"></textarea></td>
        <td><input hidden value="${id}" name="actualizar_profe"></td>
        <td><button type="submit" class="btnGuardar btn btn-primary my-2 py-2" id="btnGuardarR" name="btnGuardar" value="Guardar">Guardar</button></td>`;
        tbody.appendChild(newTr);
        evento.preventDefault();
    }
    function actualizar_admin(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.listado_admin');
        mostrar.style.display="none";
        let tbody = document.querySelector('.tbody_mostrar');
        let newTr = document.createElement('tr');
        newTr.classList.add('.update_admin');
        newTr.innerHTML = `<td><textarea title="Introduce el nuevo nombre" type="text" class="form-control py-2 my-2 admin_nombre" name="admin_nombre"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo apellido" type="text" class="form-control py-2 my-2 ml-1 admin_apellido" name="admin_apellido"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo correo" type="text" class="form-control py-2 my-2 admin_correo" name="admin_correo"  style="width: 6rem;"></textarea></td>
        <td><input hidden value="${id}" name="actualizar_admin"></td>
        <td><button type="submit" class="btnGuardar btn btn-primary my-2 py-2" id="btnGuardarR" name="btnGuardar" value="Guardar">Guardar</button></td>`;
        tbody.appendChild(newTr);
        evento.preventDefault();
    }
    function actualizar_modulo(id,users,ciclos){
      
        let evento = window.event;
        let mostrar = evento.target.closest('.listado_modulo');
        mostrar.style.display="none";
        let tbody = document.querySelector('.tbody_mostrar');
        let newTr = document.createElement('tr');
        let newSelect = document.createElement('select');
        let newSelectCiclos = document.createElement('select');
        newSelectCiclos.classList.add('custom-select','select_ciclo');
        newSelect.classList.add('custom-select','select_profe');
        newSelect.setAttribute('name','select_profe');
        newSelectCiclos.setAttribute('name','select_ciclo');
        newTr.classList.add('.update_modulo');
        newTr.innerHTML = `<td><textarea title="Introduce el nuevo modulo" type="text" class="form-control py-2 my-2 modulo_nombre" name="modulo_nombre"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo descrip_modulo" type="text" class="form-control py-2 my-2 ml-1 descrip_modulo" name="descrip_modulo"  style="width: 6rem;"></textarea></td>
        <td><input hidden value="${id}" name="actualizar_modulo"></td>
        <td><button type="submit" class="btnGuardar btn btn-primary my-2 py-2 btn_prof" id="btnGuardarR" name="btnGuardar" value="Guardar">Guardar</button></td>`;
        users.forEach(element => {
            if(element.rol == "profesor"){
            newSelect.innerHTML += `<td><option class=" seleccionar_p" value="${element.id}">${element.nombre} ${element.apellido}</option></td>`;
            newTr.appendChild(newSelect);}
        });
        ciclos.forEach(element => {
            newSelectCiclos.innerHTML += `<td><option class="seleccionar_c" value="${element.id}">${element.ciclo}</option></td>`;
            newTr.appendChild(newSelectCiclos);
        });
    
        tbody.appendChild(newTr);
        evento.preventDefault();
    }
    function actualizar_uf(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.listado_uf');
        mostrar.style.display="none";
        let tbody = document.querySelector('.tbody_mostrar');
        let newTr = document.createElement('tr');
        newTr.classList.add('.update_uf');
        newTr.innerHTML = `<td><textarea title="Introduce el nuevo nombre de la uf" type="text" class="form-control py-2 my-2 uf_nombre" name="uf_nombre"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce la nueva descripcion de la uf " type="text" class="form-control py-2 my-2 ml-1 uf_descrip" name="uf_descrip"  style="width: 6rem;"></textarea></td>
        <td><input title="Introduce las nuevas horas de la uf" type="number" class="form-control py-2 my-2 uf_horas" name="uf_horas" min="10" max="60" style="width: 6rem;"></td>
        <td><input hidden value="${id}" name="actualizar_uf"></td>
        <td><button type="submit" class="btnGuardar btn btn-primary my-2 py-2" id="btnGuardarR" name="btnGuardar" value="Guardar">Guardar</button></td>`;
        tbody.appendChild(newTr);
        evento.preventDefault();
    }
    function actualizar_ciclo(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.listado_ciclo');
        mostrar.style.display="none";
        let tbody = document.querySelector('.tbody_mostrar');
        let newTr = document.createElement('tr');
        newTr.classList.add('.update_uf');
        newTr.innerHTML = `<td><textarea title="Introduce el nuevo nombre del ciclo" type="text" class="form-control py-2 my-2 ciclo_nombre" name="ciclo_nombre"  style="width: 6rem;"></textarea></td>
        <td><textarea title="Introduce el nuevo periodo de la ciclo" type="text" class="form-control py-2 my-2 ml-1 ciclo_periodo" name="ciclo_periodo"  style="width: 6rem;"></textarea></td>
        <td><input hidden value="${id}" name="actualizar_ciclo"></td>
        <td><button type="submit" class="btnGuardar btn btn-primary my-2 py-2" id="btnGuardarR" name="btnGuardar" value="Guardar">Guardar</button></td>`;
        tbody.appendChild(newTr);
        evento.preventDefault();
    }
    function actualizar_nota(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.nota_alumno');
        console.log(mostrar);
        console.log('---------')
        mostrar.innerHTML = `<input type="number" class="form-control nueva_nota_alumno" title="Introduce una nota entrel el 0 y el 9" name="notas_alumno[]" value="0" style="width: 8rem;" min="0" max="9">
        <input hidden name="actualizar_notas[]" value="${id}">`;
        document.querySelector('#btnGuardarN').style.display="block";
        evento.preventDefault();
    }
  
/************************************************************************************ */

    