SET FOREIGN_KEY_CHECKS=1;

/*Sentencia para crear el centro*/
insert into centros(cod, nombre, localidad, created_at, updated_at) 
values(13002691, 'CIFP Virgen de Gracia', 'Puertollano', now(), now());


/*Sentencia para llenar los cursos*/
insert into cursos(id_curso, descripcion, ano_academico, familia, horas, centros_cod, created_at, updated_at)
select 	datunidades.GRUPO as id_curso, 
		datunidades.CURSO as descripcion, 
		datunidades.ANNO as ano_academico,
        datunidades.ESTUDIO as familia,  
        null as horas, 
		13002691 as centro_cod, 
        now() as created_at, 
        now() as updated_at 
        from datunidades;
        
/* Sentencia para insertar a todos los profesores en la tabla usuarios*/
insert into usuarios(dni, nombre, apellidos, domicilio, email, pass, telefono, movil, iban, created_at, updated_at)
select 	datprofesores.DNI, 
		datprofesores.NOMBRE, 
		datprofesores.APELLIDOS, 
		datprofesores.DOMICILIO, 
		datprofesores.EMAIL, 
		1 as pass, 
		datprofesores.TELEFONO, 
		null as movil, 
        null as iban, 
		now() as created_at, 
		now() as updated_at
from datprofesores;

/* Sentencia para insertar los roles */
insert into roles(id, nombre, created_at, updated_at)
values(1, 'Administrador', now(), now());

insert into roles(id, nombre, created_at, updated_at)
values(2, 'Tutor', now(), now());

insert into roles(id, nombre, created_at, updated_at)
values(3, 'Alumno', now(), now());

insert into roles(id, nombre, created_at, updated_at)
values(4, 'Tutor - Administrador', now(), now());

/* Sentencia para insertar los alumnos matriculados que tienen matricula diferente de anulada*/
insert into usuarios(dni, nombre, apellidos, domicilio, email, pass, telefono, movil, iban, created_at, updated_at)
select  datAlumnos.DNI, 
		datAlumnos.NOMBRE, 
        datAlumnos.APELLIDOS, 
        datAlumnos.DOMICILIO, 
        datAlumnos.EMAIL_ALUMNO, 
		1 as pass, 
        datAlumnos.TELEFONO, 
        datAlumnos.MOVIL, 
        null as iban,  
        now(), 
        now()
from datmatriculas, datAlumnos
where datmatriculas.ALUMNO = datAlumnos.ALUMNO
and datAlumnos.ALUMNO = datmatriculas.ALUMNO and datmatriculas.ESTADOMATRICULA <> 'Anulada';

/* Sentencia para insertar los roles de los tutores*/
insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
select null, 2 as rol_id, datprofesores.DNI, now(), now()
from datprofesores, datunidades
where datunidades.TUTOR = concat(datprofesores.APELLIDOS, ', ',datprofesores.NOMBRE);

/* Sentencia para dar de alta con permiso de Administrador*/
/* Ana Belen Directora*/
insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
select null, 1 as rol_id, datprofesores.DNI, now(), now()
from datprofesores
where DNI='05664525Q';

/* Jose Alberto como administrador */
insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
select null, 1 as rol_id, datprofesores.DNI, now(), now()
from datprofesores
where DNI='05679252T';

/* Sentencia para insertar los roles de los alumnos*/
insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
select null, 3 as rol_id, datAlumnos.DNI, now(), now()
from datmatriculas, datAlumnos
where datmatriculas.ALUMNO = datAlumnos.ALUMNO
and datAlumnos.ALUMNO = datmatriculas.ALUMNO and datmatriculas.ESTADOMATRICULA <> 'Anulada';

/* Sentencia para dar de alta los profesores que son tutores de cada curso*/
insert into tutores(idtutores, cursos_id_curso, usuarios_dni, created_at, updated_at)
select null, datunidades.GRUPO, datprofesores.DNI, now(), now() 
from datunidades, datprofesores
where datunidades.TUTOR = concat(datprofesores.APELLIDOS, ', ',datprofesores.NOMBRE);

/* Sentencia para dar de alta los alumnos en los cursos que estan matriculados */
insert into matriculados(idmatriculados, usuarios_dni, cursos_id_curso, created_at, updated_at)
select null, datAlumnos.DNI, datmatriculas.GRUPO, now(), now()
from datAlumnos, datmatriculas
where datAlumnos.ALUMNO = datmatriculas.ALUMNO
and datmatriculas.ESTADOMATRICULA <> 'Anulada';
