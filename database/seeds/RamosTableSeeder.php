<?php

use Illuminate\Database\Seeder;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RamosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
        public function run()
        {

        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Matemática I', 'nombre_ramo_html' => 'Matem&aacute;tica I','nombre_ramo_no_tilde' => 'Matematica I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Análisis y Diseño Orientado a Objeto', 'nombre_ramo_html' => 'An&aacute;lisis y Dise&ntilde;o Orientado a Objeto','nombre_ramo_no_tilde' => 'Analisis y Diseño Orientado a Objeto'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Fundamentos de Programación', 'nombre_ramo_html' => 'Fundamentos de Programaci&oacute;n','nombre_ramo_no_tilde' => 'Fundamentos de Programacion'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'IT Essentials', 'nombre_ramo_html' => 'IT Essentials','nombre_ramo_no_tilde' => 'IT Essentials'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Técnicas de Comunicación Oral y Escrita', 'nombre_ramo_html' => 'T&eacute;cnicas de Comunicaci&oacute;n Oral y Escrita','nombre_ramo_no_tilde' => 'Tecnicas de Comunicacion Oral y Escrita'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Inglés I', 'nombre_ramo_html' => 'Ingl&eacute;s I','nombre_ramo_no_tilde' => 'Ingles I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Matemática II', 'nombre_ramo_html' => 'Matem&aacute;tica II','nombre_ramo_no_tilde' => 'Matematica II'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Programación I', 'nombre_ramo_html' => 'Taller de Programaci&oacute;n I','nombre_ramo_no_tilde' => 'Taller de Programacion I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Diseño de Base de Datos', 'nombre_ramo_html' => 'Dise&ntilde;o de Base de Datos','nombre_ramo_no_tilde' => 'Diseño de Base de Datos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Networking I', 'nombre_ramo_html' => 'Networking I','nombre_ramo_no_tilde' => 'Networking I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Organización y Métodos de Trabajo', 'nombre_ramo_html' => 'Organizaci&oacute;n y M&eacute;todos de Trabajo','nombre_ramo_no_tilde' => 'Organizacion y Metodos de Trabajo'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Inglés II', 'nombre_ramo_html' => 'Ingl&eacute;s II','nombre_ramo_no_tilde' => 'Ingles II'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Programación II', 'nombre_ramo_html' => 'Taller de Programaci&oacute;n II','nombre_ramo_no_tilde' => 'Taller de Programacion II'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Programación III', 'nombre_ramo_html' => 'Taller de Programaci&oacute;n III','nombre_ramo_no_tilde' => 'Taller de Programacion III'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Base de Datos', 'nombre_ramo_html' => 'Taller de Base de Datos','nombre_ramo_no_tilde' => 'Taller de Base de Datos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Mantención de Software', 'nombre_ramo_html' => 'Taller de Mantenci&oacute;n de Software','nombre_ramo_no_tilde' => 'Taller de Mantencion de Software'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Sistemas de Información I', 'nombre_ramo_html' => 'Sistemas de Informaci&oacute;n I','nombre_ramo_no_tilde' => 'Sistemas de Informacion I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Inglés III', 'nombre_ramo_html' => 'Ingl&eacute;s III','nombre_ramo_no_tilde' => 'Ingles III'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Competencias de Empleabilidad', 'nombre_ramo_html' => 'Competencias de Empleabilidad','nombre_ramo_no_tilde' => 'Competencias de Empleabilidad'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Programación IV', 'nombre_ramo_html' => 'Taller de Programaci&oacute;n IV','nombre_ramo_no_tilde' => 'Taller de Programacion IV'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Herramientas de Desarrollo Web', 'nombre_ramo_html' => 'Herramientas de Desarrollo Web','nombre_ramo_no_tilde' => 'Herramientas de Desarrollo Web'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Sistemas Operativos I', 'nombre_ramo_html' => 'Taller de Sistemas Operativos I','nombre_ramo_no_tilde' => 'Taller de Sistemas Operativos I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Sistemas de Información II', 'nombre_ramo_html' => 'Sistemas de Informaci&oacute;n II','nombre_ramo_no_tilde' => 'Sistemas de Informacion II'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Inglés IV', 'nombre_ramo_html' => 'Ingl&eacute;s IV','nombre_ramo_no_tilde' => 'Ingles IV'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Ingeniería y Gestión de Requerimientos', 'nombre_ramo_html' => 'Ingenier&iacute;a y Gesti&oacute;n de Requerimientos','nombre_ramo_no_tilde' => 'Ingenieria y Gestion de Requerimientos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Ingeniería de Software', 'nombre_ramo_html' => 'Ingenier&iacute;a de Software','nombre_ramo_no_tilde' => 'Ingenieria de Software'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Modelamiento de Procesos de Negocio', 'nombre_ramo_html' => 'Modelamiento de Procesos de Negocio','nombre_ramo_no_tilde' => 'Modelamiento de Procesos de Negocio'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Sistemas Operativos II', 'nombre_ramo_html' => 'Taller de Sistemas Operativos II','nombre_ramo_no_tilde' => 'Taller de Sistemas Operativos II'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Contabilidad, Costos y Presupuestos', 'nombre_ramo_html' => 'Contabilidad, Costos y Presupuestos','nombre_ramo_no_tilde' => 'Contabilidad, Costos y Presupuestos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Inglés V', 'nombre_ramo_html' => 'Ingl&eacute;s V','nombre_ramo_no_tilde' => 'Ingles V'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Cálculo I', 'nombre_ramo_html' => 'C&aacute;lculo I','nombre_ramo_no_tilde' => 'Calculo I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Inglés para TI', 'nombre_ramo_html' => 'Ingl&eacute;s para TI','nombre_ramo_no_tilde' => 'Ingles para TI'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Gestión de Proyectos Informáticos', 'nombre_ramo_html' => 'Gesti&oacute;n de Proyectos Inform&aacute;ticos','nombre_ramo_no_tilde' => 'Gestion de Proyectos Informaticos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Arquitectura de Tecnología Empresarial', 'nombre_ramo_html' => 'Arquitectura de Tecnolog&iacute;a Empresarial','nombre_ramo_no_tilde' => 'Arquitectura de Tecnologia Empresarial'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Ética y Legislación', 'nombre_ramo_html' => 'Ã‰tica y Legislaci&oacute;n','nombre_ramo_no_tilde' => 'etica y Legislacion'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Preparación y Evaluación de Proyectos', 'nombre_ramo_html' => 'Preparaci&oacute;n y Evaluaci&oacute;n de Proyectos','nombre_ramo_no_tilde' => 'Preparacion y Evaluacion de Proyectos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Estadística y Probabilidad', 'nombre_ramo_html' => 'Estad&iacute;stica y Probabilidad','nombre_ramo_no_tilde' => 'Estadistica y Probabilidad'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Proyecto de Software', 'nombre_ramo_html' => 'Taller de Proyecto de Software','nombre_ramo_no_tilde' => 'Taller de Proyecto de Software'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Proyecto de Infraestructura', 'nombre_ramo_html' => 'Taller de Proyecto de Infraestructura','nombre_ramo_no_tilde' => 'Taller de Proyecto de Infraestructura'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Gestión de Servicios y Gobernabilidad de TI', 'nombre_ramo_html' => 'Gesti&oacute;n de Servicios y Gobernabilidad de TI','nombre_ramo_no_tilde' => 'Gestion de Servicios y Gobernabilidad de TI'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Comportamiento Organizacional y Recursos Humanos', 'nombre_ramo_html' => 'Comportamiento Organizacional y Recursos Humanos','nombre_ramo_no_tilde' => 'Comportamiento Organizacional y Recursos Humanos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Tecnologías de Información y Comunicación I', 'nombre_ramo_html' => 'Tecnolog&iacute;as de Informaci&oacute;n y Comunicaci&oacute;n I','nombre_ramo_no_tilde' => 'Tecnologias de Informacion y Comunicacion I'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller Integral de Proyectos Informáticos', 'nombre_ramo_html' => 'Taller Integral de Proyectos Inform&aacute;ticos','nombre_ramo_no_tilde' => 'Taller Integral de Proyectos Informaticos'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Seguridad y Auditoría Informática', 'nombre_ramo_html' => 'Seguridad y Auditor&iacute;a Inform&aacute;tica','nombre_ramo_no_tilde' => 'Seguridad y Auditoria Informatica'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Planificación Estratégica', 'nombre_ramo_html' => 'Planificaci&oacute;n Estrat&eacute;gica','nombre_ramo_no_tilde' => 'Planificacion Estrategica'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Tecnologías de Información y Comunicación II', 'nombre_ramo_html' => 'Tecnolog&iacute;as de Informaci&oacute;n y Comunicaci&oacute;n II','nombre_ramo_no_tilde' => 'Tecnologias de Informacion y Comunicacion II'));
        \DB::table('ramos')->insertGetId(array('nombre_ramo' => 'Taller de Investigación Operativa', 'nombre_ramo_html' => 'Taller de Investigaci&oacute;n Operativa','nombre_ramo_no_tilde' => 'Taller de Investigacion Operativa'));

        }

}
