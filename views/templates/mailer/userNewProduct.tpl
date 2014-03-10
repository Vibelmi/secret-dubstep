{*
This template is for send an advice to the USERS when a nes product is added.

Variables:
    $Content.name = The name of the new product
    $Content.img = The path to the product main image.
    $Content.description.short = A short description of the product characteristics
    $Content.description.spec = Detailed description of all the product specifications
    $Content.id = The Id of the product in the database
*}
<div>
<h1>-{$Content.name}</h1>
<div id="content"><img style="width:100%;" src="http://{$globals.HOST}{$globals.home[0]}{$Content.img}"><b style="display:block;margin:10px 0px;">{$Content.description.short}</b><br>
<a style="display:block;margin:10px 0px;font-size:25px;text-align:right;" href="" >Check this new product here!</a></div>
</div>
