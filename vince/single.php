<?php
/**
 * @package WordPress
 * @subpackage The Crest - Vince Camuto
 */

$post = $wp_query->post;

if(in_category('17')) {
    include('single-letters.php');
} elseif ( in_category(array('@VinceCamuto' , 'Ask our Staffers' , 'VC Employees' , 'Interviews'))) {
    include('single-interview.php');
} else {
    include('single-default.php');
}
