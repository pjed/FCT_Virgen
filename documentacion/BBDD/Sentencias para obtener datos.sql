SELECT usuarios.dni, usuarios.nombre, cursos.id_curso 
FROM usuarios, tutores, cursos
where cursos.id_curso = tutores.cursos_id_curso 
and usuarios.dni = tutores.usuarios_dni
and cursos.id_curso='2DAW';

select * 
FROM usuarios, matriculados, cursos
where cursos_id_curso='2DAW' and usuarios.dni = matriculados.usuarios_dni
and matriculados.cursos_id_curso = cursos.id_curso;