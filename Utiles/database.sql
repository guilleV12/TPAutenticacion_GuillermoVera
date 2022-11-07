-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 17-08-2012 a las 00:43:05
-- Versión del servidor: 5.0.21
-- Versión de PHP: 5.1.4
-- 
-- Base de datos: `bdautentic`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `persona`
-- 

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `usnombre` varchar(50)  NOT NULL,
  `uspass` varchar(50) NOT NULL,
  `usmail` varchar(50)  NOT NULL,
  `usdeshabilitado` timestamp,
  PRIMARY KEY  (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 
-- Estructura de tabla para la tabla `persona`
-- 

CREATE TABLE `rol` (
  `idrol` bigint(20)  NOT NULL,
  `roldescripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 

 -- 
-- Estructura de tabla para la tabla `persona`
-- 

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20)  NOT NULL,
  `idrol` bigint(20) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `usuariorol` ADD KEY `idrol_fk` (`idrol`);


ALTER TABLE `usuariorol`
ADD CONSTRAINT `idusuario_fk` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
ADD CONSTRAINT `idrol_fk` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`);