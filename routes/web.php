<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

function convert_to ( $source, $target_encoding )
{
    // detect the character encoding of the incoming file
    $encoding = mb_detect_encoding( $source, "auto" );

    // escape all of the question marks so we can remove artifacts from
    // the unicode conversion process
    $target = str_replace( "?", "[question_mark]", $source );

    // convert the string to the target encoding
    $target = mb_convert_encoding( $target, $target_encoding, $encoding);

    // remove any question marks that have been introduced because of illegal characters
    $target = str_replace( "?", "", $target );

    // replace the token string "[question_mark]" with the symbol "?"
    $target = str_replace( "[question_mark]", "?", $target );

    return $target;
}

Route::get('repaire',function(){
    foreach(\App\Department::all() as $dep)
    {

        $update = \App\Department::find($dep->id);
       // echo mb_convert_encoding($dep->name, 'ISO-8859-1');// $dep->name;
        echo convert_to($dep->name, "ISO-8859-1").'<br>';
        $update->name = $dep->name;
        $update->save();
    }
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
