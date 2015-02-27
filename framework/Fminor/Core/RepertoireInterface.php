<?php
namespace Fminor\Core;

interface RepertoireInterface
{
	/**
	 * Returns the repertoire's name
	 *
	 * @return string name of the repertoire
	 */
	function getName();
	/**
	 * Returns the repertoire's chords registered
	 *
	 * @return array chords registered
	 */
	function getChords();
	/**
	 * Returns the repertoire's commands registered
	 *
	 * @return array commands registered
	 */
	function getCommands();
	/**
	* Resturns the repertoire's generators registered
	*
	* @return array generators registered
	*/
	function getGenerators();
}
