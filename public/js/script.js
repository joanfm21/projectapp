/*********************Más info**************************/

let mas_info = document.querySelector('.btn_mas_info');
let salir_mas_info = document.querySelector('.salir');

mas_info.addEventListener('click', () =>{
    document.querySelector('.mas_info').style.display="block";
});

salir_mas_info.addEventListener('click', () =>{
    document.querySelector('.mas_info').style.display="none";
});

/********************************************************/

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
        console.log(evento.target)
        let tr = evento.target.closest('.listado_alumno');
        let td = document.createElement('td');
        let newSelectCiclos = document.createElement('select');
        newSelectCiclos.classList.add('custom-select','select_ciclo_alumno');
        newSelectCiclos.setAttribute('name','select_ciclo_alumno[]');
        let alumno_dni = evento.target.closest('.listado_alumno').querySelector('.alumno_dni');
        let alumno_nombre = evento.target.closest('.listado_alumno').querySelector('.alumno_nombre');
        let alumno_apellido = evento.target.closest('.listado_alumno').querySelector('.alumno_apellido');
        let alumno_direc = evento.target.closest('.listado_alumno').querySelector('.alumno_direc');
        let alumno_telef = evento.target.closest('.listado_alumno').querySelector('.alumno_telef');
        let alumno_cp = evento.target.closest('.listado_alumno').querySelector('.alumno_cp');
        let alumno_fecha = evento.target.closest('.listado_alumno').querySelector('.alumno_fecha');
        let alumno_correo = evento.target.closest('.listado_alumno').querySelector('.alumno_correo');
        let alumno_ciclo = evento.target.closest('.listado_alumno').querySelector('.alumno_ciclo');
        alumno_dni.innerHTML = `<textarea title="Introduce el nuevo Dni" type="text" class="form-control py-2 my-2 alumno_dni up_alumno" name="alumno_dni[]"  style="width: 9.50rem;">${alumno_dni.textContent}</textarea>`;
        alumno_nombre.innerHTML =`<textarea title="Introduce el nuevo nombre" type="text" class="form-control py-2 my-2 ml-1 alumno_nombre up_alumno" name="alumno_nombre[]"  style="width: 9.50rem;">${alumno_nombre.textContent}</textarea>`;
        alumno_apellido.innerHTML = `<textarea title="Introduce el nuevo apellido" type="text" class="form-control py-2 my-2 ml-1 alumno_apellido up_alumno" name="alumno_apellido[]"  style="width: 9.50rem;">${alumno_apellido.textContent}</textarea>`;
        alumno_direc.innerHTML = `<textarea title="Introduce la nueva dirección" type="text" class="form-control py-2 my-2 ml-3 alumno_direc up_alumno" name="alumno_direc[]"  style="width: 9.50rem;">${alumno_direc.textContent}</textarea>`;
        alumno_telef.innerHTML = `<textarea title="Introduce el nuevo teléfono" type="text" class="form-control py-2 my-2 ml-2 alumno_telef up_alumno" name="alumno_telef[]"  style="width: 9.50rem;">${alumno_telef.textContent}</textarea>`;
        alumno_cp.innerHTML = `<textarea title="Introduce el nuevo código postal" type="text" class="form-control py-2 my-2 alumno_cp up_alumno" name="alumno_cp[]"  style="width: 9.50rem;">${alumno_cp.textContent}</textarea>`;
        alumno_fecha.innerHTML = `<textarea title="Introduce la nueva fecha de nacimiento" type="text" class="form-control py-2 my-2 ml-4 alumno_fn up_alumno" name="alumno_fn[]"  style="width: 9.50rem;">${alumno_fecha.textContent}</textarea>`;
        alumno_correo.innerHTML = `<textarea title="Introduce el nuevo correo" type="text" class="form-control py-2 my-2 alumno_correo up_alumno" name="alumno_correo[]"  style="width: 9.50rem;">${alumno_correo.textContent}</textarea>`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_alumno[]">`;
        ciclos.forEach(element => { 
            newSelectCiclos.innerHTML += `<option value="${element.ciclo}">${element.ciclo}</option>`;
        });
        alumno_ciclo.innerHTML = "";
        alumno_ciclo.appendChild(newSelectCiclos);
        tr.appendChild(td);
        document.querySelector('#btnGuardar').style.display="block";
        evento.preventDefault();
    }
    function actualizar_profesores(id,ciclos){
        let evento = window.event;
        console.log(evento.target)
        let tr = evento.target.closest('.listado_profe');
        let td = document.createElement('td');
        let newSelectCiclos = document.createElement('select');
        newSelectCiclos.classList.add('custom-select','select_ciclo_profe');
        newSelectCiclos.setAttribute('name','select_ciclo_profe[]');
        let nombre_profe = evento.target.closest('.listado_profe').querySelector('.nombre_p');
        let apellido_profe = evento.target.closest('.listado_profe').querySelector('.apellido_p');
        let email_profe = evento.target.closest('.listado_profe').querySelector('.email_p');
        let ciclo_profe = evento.target.closest('.listado_profe').querySelector('.ciclo_p');
        nombre_profe.innerHTML = `<textarea title="Introduce el nuevo nombre" type="text" class="form-control py-2 my-2 profe_nombre" name="profe_nombre[]"  style="width: 9.50rem;">${nombre_profe.textContent}</textarea>`;
        apellido_profe.innerHTML = `<textarea title="Introduce el nuevo apellido" type="text" class="form-control py-2 my-2 ml-1 profe_apellido" name="profe_apellido[]"  style="width: 9.50rem;">${apellido_profe.textContent}</textarea>`;
        email_profe.innerHTML = `<textarea title="Introduce el nuevo correo" type="text" class="form-control py-2 my-2 profe_correo" name="profe_correo[]"  style="width: 9.50rem;">${email_profe.textContent}</textarea>`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_profe[]">`;
        ciclos.forEach(element => {
            newSelectCiclos.innerHTML += `<option class="seleccionar_c_p" value="${element.ciclo}">${element.ciclo}</option>`;
        });
        ciclo_profe.innerHTML = "";
        ciclo_profe.appendChild(newSelectCiclos);
        tr.appendChild(td);
        document.querySelector('#btnGuardar').style.display="block";
        evento.preventDefault();
    }
    function actualizar_admin(id){
        let evento = window.event;
        let tr = evento.target.closest('.listado_admin');
        let td = document.createElement('td');
        let nombre_ad = evento.target.closest('.listado_admin').querySelector('.nombre_ad');
        let apellido_ad = evento.target.closest('.listado_admin').querySelector('.apellido_ad');
        let email_ad = evento.target.closest('.listado_admin').querySelector('.email_ad');
        nombre_ad.innerHTML = `<textarea title="Introduce el nuevo nombre" type="text" class="form-control py-2 my-2 admin_nombre" name="admin_nombre[]"  style="width: 9.50rem;">${nombre_ad.textContent}</textarea>`;
        apellido_ad.innerHTML = `<textarea title="Introduce el nuevo apellido" type="text" class="form-control py-2 my-2 ml-1 admin_apellido" name="admin_apellido[]"  style="width: 9.50rem;">${apellido_ad.textContent}</textarea>`;
        email_ad.innerHTML = `<textarea title="Introduce el nuevo correo" type="text" class="form-control py-2 my-2 admin_correo" name="admin_correo[]"  style="width: 9.50rem;">${email_ad.textContent}</textarea>`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_admin[]">`;
        tr.appendChild(td);
        document.querySelector('#btnGuardar').style.display="block";
        evento.preventDefault();
    }
    function actualizar_modulo(id,users,ciclos){
      
        let evento = window.event;
        let tr = evento.target.closest('.listado_modulo');
        let td = document.createElement('td');
        let nombre_modu = evento.target.closest('.listado_modulo').querySelector('.nombre_modu');
        let descrip_modu = evento.target.closest('.listado_modulo').querySelector('.descrip_modu');
        let ciclo_modu = evento.target.closest('.listado_modulo').querySelector('.ciclo_modu');
        let profe_modu = evento.target.closest('.listado_modulo').querySelector('.profe_modu');
        let newSelectProfe = document.createElement('select');
        let newSelectCiclos = document.createElement('select');
        newSelectCiclos.classList.add('custom-select','select_ciclo_modu');
        newSelectCiclos.setAttribute('name','select_ciclo_modu[]');
        newSelectProfe.classList.add('custom-select','select_profe_modu');
        newSelectProfe.setAttribute('name','select_profe_modu[]');
        nombre_modu.innerHTML = `<textarea title="Introduce el nuevo modulo" type="text" class="form-control py-2 my-2 modulo_nombre" name="modulo_nombre[]"  style="width: 9.50rem;">${nombre_modu.textContent}</textarea>`;
        descrip_modu.innerHTML= `<textarea title="Introduce el nuevo descrip_modulo" type="text" class="form-control py-2 my-2 ml-1 descrip_modulo" name="descrip_modulo[]"  style="width: 9.50rem;">${descrip_modu.textContent}</textarea>`;
        users.forEach(element => {
            if(element.rol == "profesor"){
                newSelectProfe.innerHTML += `<option class=" seleccionar_p" value="${element.id}">${element.nombre} ${element.apellido}</option>`;
            }
        });
        profe_modu.innerHTML = "";
        profe_modu.appendChild(newSelectProfe);

        ciclos.forEach(element => {
            newSelectCiclos.innerHTML += `<option class="seleccionar_c" value="${element.ciclo}">${element.ciclo}</option>`;
        });
        ciclo_modu.innerHTML = "";
        ciclo_modu.appendChild(newSelectCiclos);

        td.innerHTML = `<input hidden value="${id}" name="actualizar_modulo[]">`;
        tr.appendChild(td);
        document.querySelector('#btnGuardar').style.display="block";
        evento.preventDefault();
    }
    function actualizar_uf(id){
        let evento = window.event;
        let tr = evento.target.closest('.listado_uf');
        let td = document.createElement('td');
        let nombre_uf = evento.target.closest('.listado_uf').querySelector('.nombre_uf');
        let descrip_uf = evento.target.closest('.listado_uf').querySelector('.descrip_uf');
        let horas_uf = evento.target.closest('.listado_uf').querySelector('.horas_uf');
        nombre_uf.innerHTML = `<textarea title="Introduce el nuevo nombre de la uf" type="text" class="form-control py-2 my-2 uf_nombre" name="uf_nombre[]"  style="width: 9.50rem;">${nombre_uf.textContent}</textarea>`;
        descrip_uf.innerHTML = `<textarea title="Introduce la nueva descripcion de la uf " type="text" class="form-control py-2 my-2 ml-1 uf_descrip" name="uf_descrip[]"  style="width: 9.50rem;">${descrip_uf.textContent}</textarea>`;
        horas_uf.innerHTML = `<input title="Nuevas horas de la uf" type="number" class="form-control py-2 my-2" id="uf_horas" name="uf_horas[]" value="${horas_uf.textContent}" min="10" style="width: 9.50rem;">`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_uf[]">`;
        tr.appendChild(td);
        document.querySelector('#btnGuardar').style.display="block";
        evento.preventDefault();
    }
    function actualizar_ciclo(id){
        let evento = window.event;
        console.log(evento.target)
        let tr = evento.target.closest('.listado_ciclo');
        let td = document.createElement('td');
        let ciclo = evento.target.closest('.listado_ciclo').querySelector('.ciclo_n');
        let periodo = evento.target.closest('.listado_ciclo').querySelector('.periodo');
        let periodo_fin = evento.target.closest('.listado_ciclo').querySelector('.periodo_fin');
        ciclo.innerHTML = `<textarea title="Introduce el nuevo nombre del ciclo" type="text" class="form-control py-2 my-2 ciclo_nombre" name="ciclo_nombre[]"  style="width: 9.50rem;">${ciclo.textContent}</textarea>`;
        periodo.innerHTML = `<input title="Introduce el nuevo periodo de la ciclo" type="month" class="form-control py-2 my-2 ml-1 ciclo_periodo" value="${periodo.textContent}"; name="ciclo_periodo[]" style="width: 9.50rem;">`;
        periodo_fin.innerHTML = `<input title="Introduce la nueva fecha del fin del ciclo" type="month" class="form-control py-2 my-2 ml-1 ciclo_periodo_fin" value="${periodo_fin.textContent}"; name="ciclo_periodo_fin[]" style="width: 9.50rem;">`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_ciclo[]">`;
        tr.appendChild(td);
        document.querySelector('#btnGuardarC').style.display="block";
        evento.preventDefault();

    }
    function actualizar_nota(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.nota_alumno');
        let mostrar_notas = evento.target.closest('.nota_alumno').querySelector('.cualificacion');
        let tr = evento.target.closest('.listado_uf_notas');
        let td = document.createElement('td');
        console.log(mostrar);
        console.log('---------');
        console.log(mostrar_notas.value);
        mostrar.innerHTML = `<input type="number" class="form-control nueva_nota_alumno" title="Introduce una nota entrel el 1 y el 10" name="notas_alumno[]" value="${mostrar_notas.value}" style="width: 8rem;" min="1" max="10">`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_notas[]">`;
        tr.appendChild(td);
        document.querySelector('#btnGuardarN').style.display="block";
        evento.preventDefault();
    }
    function actualizar_nota_modu(id){
        let evento = window.event;
        let mostrar = evento.target.closest('.nota_alumno_modu');
        let mostrar_notas = evento.target.closest('.nota_alumno_modu').querySelector('.cualificacion');
        let tr = evento.target.closest('.modulo_notas_alumno');
        let td = document.createElement('td');
        console.log(mostrar);
        console.log('---------');
        console.log(mostrar_notas.value);
        mostrar.innerHTML = `<input type="number" class="form-control nueva_nota_alumno" title="Introduce una nota entrel el 1 y el 10" name="notas_alumno_modu[]" value="${mostrar_notas.value}" style="width: 8rem;" min="1" max="10">`;
        td.innerHTML = `<input hidden value="${id}" name="actualizar_notas[]">`;
        tr.appendChild(td);
        document.querySelector('#btnGuardarN').style.display="block";
        evento.preventDefault();
    }
  
/************************************************************************************ */


/*********************Validaciones*********************/


/********************************************************/