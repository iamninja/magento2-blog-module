<?php
namespace Brokenspacebars\Blog\Api\Data;

interface PostInterface
{
	// Define constants for keys
	const POST_ID		= 'post_id';
	const URL_KEY		= 'url_key';
	const TITLE			= 'title';
	const CONTENT		= 'content';
	const CREATION_TIME	= 'creation_time';
	const UPDATE_TIME	= 'update_time';
	const IS_ACTIVE		= 'is_active';

	// Define getters
	public function getId();
	public function getUrlKey();
	public function getTitle();
	public function getContent();
	public function getCreationTime();
	public function getUpdateTime();
	public function isActive();

	// Define setters
	public function setId($id);
	public function setUrlKey($url_key);
	public function setTitle($title);
	public function setContent($content);
	public function setCreationTime($creation_time);
	public function setUpdateTime($update_time);
	public function setIsActive($is_active);

}