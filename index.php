<html>
<head>
	<title>DHLAB : Visualisation of labs collaborations</title>
</head>
<body>
	<span id="ruler" style="visibility:hidden;white-space:nowrap;"></span>
	<div id="selection_parametres" style="width:19%;height:99%;vertical-align:top;float:left;">
		<a href="http://dhlab.epfl.ch"><img src="DHLAB_Logo.jpg" width="300px"/></a><br/><br/>
		<table style="margin-left: auto;margin-right: auto;">
		<tr>
			<td colspan="2" align="center"><h3>1. Mode d'interaction</h3></td>
		</tr>
		<tr>
			<td align="right" width="40%">Type</td>
			<td align="left" width="60%">
				<select id="mode_selection" onchange="">
					<option value="rouge" selected>Balise rouge</option>
					<option value="vert">Balise verte</option>
					<option value="bleu">Balise bleue</option>
					<option value="violet">Balise violette</option>
					<option value="changement">Changement de place</option>
					<option value="fixe">Points fixes</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><h3>2. Selection des données</h3></td>
		</tr>
		<tr>
			<td align="right">Données</td>
			<td align="left">
				<select id="data_selection">
					<option value="1" selected>Exemple</option>
					<option value="2">Import (<i>.txt</i>)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="file" onchange="readText(this)" /></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><h3>3. Grille et disposition</h3></td>
		</tr>
		<tr>
			<td align="right" width="40%">Type</td>
			<td align="left" width="60%">
				<select id="type_grille">
					<option value="hex" selected>Hexagonale</option>
					<option value="car">Carrée</option>
					<option value="ligne">Ligne</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Taille:</td>
			<td align="left"><input type="text" id="taille" size="5" value="13"></td>
		</tr>
		<tr>
			<td align="right">Ordre</td>
			<td align="left">
				<select id="disposition">
					<option value="1" selected>aléatoire</option>
					<option value="2">initial</option>
					<option value="3">aléatoire en cercle</option>
					<option value="4">initial en cercle</option>
					<option value="5">aléatoire en cercle inverse</option>
					<option value="6">initial en cercle inverse</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><button id="init_algo" type="button" onclick="make_sol_init()">Créer la solution initiale</button></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><h3>4. Selection de la méthode</h3></td>
		</tr>
		<tr>
			<td align="right">Méthode</td>
			<td align="left">
				<select id="variante">
					<option value="1" checked="checked">Variante 1</option>
					<option value="2">Variante 2</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Température</td>
			<td align="left">
				<input id="temperature" type="range" min="0" max="1" step="0.01" value="0" style="width: 50%;"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><button id="start_algo" type="button" onclick="optimize()">Lancer l'algorithme</button></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><button id="stop_algo" type="button" onclick="stop_opt()">Stopper l'algorithme</button></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><h3>5. Informations</h3></td>
		</tr>
		<tr>
			<td id="informations" colspan="2" align="center">Algorithme non lancé</td>
		</tr>
		</table>
		<br />
	</div>
	<div id="titre" style="width:79%;height:99%;vertical-align:top;float:right;">
		<h2 style="margin-left:25%;">Visualisation of labs collaborations</h2>
		<div id="solution_actuelle" style="width:99%;height:99%;vertical-align:top;float:left;"></div>
	</div>
</body>
<?php
function lecture($source){
	$results=array();
	$text = file_get_contents($source);
	$lignes=explode("\n",$text);
	$elements=explode("\t",$lignes[0]);
	for($j=0;$j<count($elements);$j++){
		array_push($results,array($elements[$j]));
	}
	for($i=1;$i<count($lignes);$i++){
		$elements=explode("\t",$lignes[$i]);
		for($j=0;$j<count($elements);$j++){
			array_push($results[$j],$elements[$j]);
		}
	}
	return $results;
}
$ex1_ids=lecture("./labs.txt");
$ex1_weights=lecture("./links.txt");
?>
<script type="application/x-javascript">
var ex1_input_ids=<?php echo '["'.implode('","',$ex1_ids[0]).'"]' ?>;
var ex1_input_colors=<?php echo '["'.implode('","',$ex1_ids[1]).'"]' ?>;
var ex1_input_ids_1=<?php echo '["' . implode('", "', $ex1_weights[0]) . '"]' ?>;
var ex1_input_ids_2=<?php echo '["' . implode('", "', $ex1_weights[1]) . '"]' ?>;
var ex1_input_weight=<?php echo '[' . implode(',', $ex1_weights[2]) . ']' ?>;
var import_input_ids='non';
var import_input_ids_1='non';
var import_input_ids_2='non';
var import_input_weight='non';
var input_ids='non';
var input_ids_colors='non';
var input_ids_colors_base='non';
var input_ids_1='non';
var input_ids_2='non';
var input_weight='non';
var taille='non';
var rayon_unit='non';
var rayon='non';
var sol_init_yesno=0;
var optimize_yesno=0;
var sol_act='non';
var eva_sol_act='non';
var matrice_distance='non';
var grille='non';
var taille_pol='non';
var type_grille='non';
var id_select_iteract='non';
var idefix=[];
var boucle='non';
function readText(filePath){
	var reader=new FileReader();
	reader.onload=function(e){
		var indice=0;
		import_input_ids=[];
		import_input_ids_1=[];
		import_input_ids_2=[];
		import_input_weight=[];
		var text=e.target.result;
		lignes=text.split('\n');
		for(var i=0,len_i=lignes.length;i<len_i;i++){
			elements=lignes[i].split('\t');
			indice=import_input_ids.indexOf(elements[0]);
			if(indice==-1){
				import_input_ids.push(elements[0]);
			}
			indice=import_input_ids.indexOf(elements[1]);
			if(indice==-1){
				import_input_ids.push(elements[1]);
			}
			import_input_ids_1.push(elements[0]);
			import_input_ids_2.push(elements[1]);
			import_input_weight.push(elements[2]);
		}
	};
	reader.readAsText(filePath.files[0]);
}
function GetRadioValue(radio_name){
	var radiobutton=document.getElementsByName(radio_name);
	var returnValue = "";
	for(var i=0;i<radiobutton.length;i++){
		if (radiobutton[i].checked==true){
			returnValue=radiobutton[i].value;
		}
	}
	return returnValue;
}
function nom_racc(name){
	var nom_lab=name;
		if(nom_lab.length>5){
			nom_lab=nom_lab.substring(0, 5); 
		}
	return nom_lab;
}
function copie(sol){
	var new_sol=[];
		for(var i=0;i<sol.length;i++){
			new_sol.push(sol[i]);
		}
	return new_sol;
}
function shuffle(liste){
	var old_liste=[];
	for(var i=0;i<liste.length;i++){
		old_liste.push(liste[i]);
	}
	var new_liste=[];
	var tirage=0;
	var index=0;
	while(old_liste.length>0){
		tirage=Math.floor(old_liste.length*Math.random());
		new_liste.push(old_liste[tirage]);
		old_liste.splice(tirage, 1);
	}
	return new_liste;
}
function poids_to_dist(){
	//model : dist =  rayon_unit / (1.1 * exp(poids-1) )
    var res=[];
	for(var i=0;i<input_ids.length;i++){
		var id_1=input_ids[i];
        var res_temp=[];
		for(var j=0;j<input_ids.length;j++){
			var id_2=input_ids[j];
            var le_poids=0;
			for(var k=0;k<input_ids_1.length;k++){
				if(id_1==input_ids_1[k] && id_2==input_ids_2[k]){
					le_poids=input_weight[k];
				}
                if(id_1==input_ids_2[k] && id_2==input_ids_1[k]){
                    le_poids=input_weight[k];
				}
			}
			if(le_poids==0){
				var la_dist='non';
			}else{
				var la_dist=rayon_unit/Math.pow(1.1,le_poids-1);
			}
            res_temp.push(la_dist);
		}
        res.push(res_temp);
	}
    return res;
}
function poids_to_dist_2(min_poids,max_poids,max_dist,min_dist){
	//model : dist = a / (poids + b)
    var b=1.0*(min_dist*max_poids-max_dist*min_poids)/(max_dist-min_dist);
    var a=1.0*max_dist*(min_poids+b);
    var res=[];
	for(var i=0;i<input_ids.length;i++){
		var id_1=input_ids[i];
        var res_temp=[];
		for(var j=0;j<input_ids.length;j++){
			var id_2=input_ids[j];
            var le_poids=0;
			for(var k=0;k<input_ids_1.length;k++){
				if(id_1==input_ids_1[k] && id_2==input_ids_2[k]){
					le_poids=input_weight[k];
				}
                if(id_1==input_ids_2[k] && id_2==input_ids_1[k]){
                    le_poids=input_weight[k];
				}
			}
            var la_dist=1.0*a/(le_poids+b);
            res_temp.push(la_dist);
		}
        res.push(res_temp);
	}
    return res;
}
function dist(id_1,id_2){
	var indice_1=input_ids.indexOf(id_1);
    var indice_2=input_ids.indexOf(id_2);
    var la_distance=matrice_distance[indice_1][indice_2];
    return la_distance;
}
function evaluation(solution){
	var balles_x=grille[1];
    var balles_y=grille[2];
    var cost=0.0;
	var dist_1=0.0;
	var dist_2=0.0;
	for(var i=0;i<solution.length;i++){
		for(var j=0;j<solution.length;j++){
			var nom_lab_1=nom_racc(solution[i]);
			var nom_lab_2=nom_racc(solution[j]);
			if(i!=j && nom_lab_1!='empty' && nom_lab_2!='empty'){
				dist_1=dist(solution[i],solution[j]);
				if(dist_1!='non'){
					dist_2=Math.sqrt((balles_x[j]-balles_x[i])*(balles_x[j]-balles_x[i])+(balles_y[j]-balles_y[i])*(balles_y[j]-balles_y[i]));
					cost+=Math.abs(dist_2-dist_1);
				}
			}
		}
	}
    return cost;
}
function evaluation_opt(solution,sol_prec,eva_prec){
	var balles_x=grille[1];
    var balles_y=grille[2];
	var part_cost_prec=0.0;
	var part_cost=0.0;
	var dist_1=0.0;
	var dist_2=0.0;
	for(var i=0;i<solution.length;i++){
		for(var j=0;j<sol_prec.length;j++){
			if(solution[i]!=sol_prec[i] || solution[j]!=sol_prec[j]){
				var nom_lab_1=nom_racc(sol_prec[i]);
				var nom_lab_2=nom_racc(sol_prec[j]);
				if(i!=j && nom_lab_1!='empty' && nom_lab_2!='empty'){
					dist_1=dist(sol_prec[i],sol_prec[j]);
					if(dist_1!='non'){
						dist_2=Math.sqrt((balles_x[j]-balles_x[i])*(balles_x[j]-balles_x[i])+(balles_y[j]-balles_y[i])*(balles_y[j]-balles_y[i]));
						part_cost_prec+=Math.abs(dist_2-dist_1);
					}
				}
				var nom_lab_1=nom_racc(solution[i]);
				var nom_lab_2=nom_racc(solution[j]);
				if(i!=j && nom_lab_1!='empty' && nom_lab_2!='empty'){
					dist_1=dist(solution[i],solution[j]);
					if(dist_1!='non'){
						dist_2=Math.sqrt((balles_x[j]-balles_x[i])*(balles_x[j]-balles_x[i])+(balles_y[j]-balles_y[i])*(balles_y[j]-balles_y[i]));
						part_cost+=Math.abs(dist_2-dist_1);
					}
				}
			}
		}
	}
    cost=eva_prec-part_cost_prec+part_cost;
    return cost;
}
function gen_balles(){
    var balles_x=[];
	var balles_x_repr=[];
    var balles_y=[];
    var balles_y_repr=[];
	if(type_grille=='car'){
		var diam=1.0/(taille-1);
		var ray=diam/2;
		for(var i=0;i<taille;i++){
			for(var j=0;j<taille;j++){
				balles_x.push(i*diam);
				balles_x_repr.push(i*diam);
				balles_y.push(j*diam);
				balles_y_repr.push(j*diam);
			}
		}
	}
	if(type_grille=='hex'){
		var diam=1.0/(taille-1);
		var decalage=diam*Math.cos(Math.PI/6);
		var ray=diam/2;
		var taille_var=0;
		var modulo=1;
		var translation=(1-Math.cos(Math.PI/6))/2;
		for(var i=0;i<taille;i++){
			modulo=(i+1)%2;
			taille_var=taille-1+modulo;
			for(var j=0;j<taille_var;j++){
				balles_x.push(translation+i*decalage);
				balles_x_repr.push(translation+i*decalage);
				balles_y.push((1-modulo)*ray+j*diam);
				balles_y_repr.push((1-modulo)*ray+j*diam);
			}
		}
	}
	if(type_grille=='ligne'){
		var diam=1.0/(taille*taille-1);
		var ray=diam/2;
		for(var i=0;i<taille*taille;i++){
			balles_x.push(i*diam);
			balles_y.push(0.5);
		}
		var diam=1.0/(taille-1);
		var ray=diam/2;
		for(var i=0;i<taille;i++){
			if(i%2==0){
				for(var j=0;j<taille;j++){
					balles_x_repr.push(i*diam);
					balles_y_repr.push(j*diam);
				}
			}else{
				for(var j=0;j<taille;j++){
					balles_x_repr.push(i*diam);
					balles_y_repr.push((taille-1-j)*diam);
				}
			}
		}
	}
    return [ray,balles_x,balles_y,balles_x_repr,balles_y_repr];
}
function visualize(sol,eva,fen){
	var code='';
	code+='<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Evaluation: <b>'+Math.round(eva)+'</b></h3>';
	code+='<svg height="95%" width="95%">';
	var coord_x=0;
	var coord_y=0;
	var coord_x_avant=0;
	var coord_y_avant=0;
	var coul_cercle='';
	var coul_texte='';
	if(type_grille=='ligne'){
		var rayon_temp=0.8*rayon;
		for(var i=0;i<grille[3].length;i++){
			coord_x_avant=coord_x;
			coord_y_avant=coord_y;
			coord_x=5+rayon_temp+taille_svg*grille[3][i];
			coord_y=5+rayon_temp+taille_svg*grille[4][i];
			if(i!=0){
				code+='<line x1="'+coord_x_avant+'" y1="'+coord_y_avant+'" x2="'+coord_x+'" y2="'+coord_y+'" style="stroke:rgb(0,0,0);stroke-width:2" />';
			}
		}
		for(var i=0;i<grille[3].length;i++){
			var nom_lab=nom_racc(sol[i]);
			coord_x_avant=coord_x;
			coord_y_avant=coord_y;
			coord_x=5+rayon_temp+taille_svg*grille[3][i];
			coord_y=5+rayon_temp+taille_svg*grille[4][i];
			if(nom_lab=='empty'){
				coul_cercle='yellow';
				coul_texte='yellow';
			}else{
				var indice=input_ids.indexOf(sol[i]);
				coul_cercle=input_ids_colors[indice];
				var indice=idefix.indexOf(sol[i]);
				if(indice!=-1){
					coul_cercle='black';
				}
				coul_texte='white';
			}
			var id_fonct="change_click('"+sol[i]+"')";
			var code_font='';
			if(sol[i]==id_select_iteract){
				coul_cercle='white';
				coul_texte='black';
			}
			code+='<circle cx="'+coord_x+'" cy="'+coord_y+'" r="'+rayon_temp+'" stroke="black" stroke-width="2" fill="'+coul_cercle+'" onclick="'+id_fonct+'" />';
			code+='<text text-anchor="middle" dominant-baseline="central" font-weight="bold"';
			code+='font-size="'+taille_pol+'" x="'+coord_x+'" y="'+coord_y+'" fill="'+coul_texte+'">'+nom_lab+'</text>';
		}
	}
	else{
		for(var i=0;i<grille[3].length;i++){
			var nom_lab=nom_racc(sol[i]);
			coord_x=5+rayon+taille_svg*grille[3][i];
			coord_y=5+rayon+taille_svg*grille[4][i];
			if(nom_lab=='empty'){
				coul_cercle='yellow';
				coul_texte='yellow';
			}else{
				var indice=input_ids.indexOf(sol[i]);
				coul_cercle=input_ids_colors[indice];
				var indice=idefix.indexOf(sol[i]);
				if(indice!=-1){
					coul_cercle='black';
				}
				coul_texte='white';
			}
			var id_fonct="change_click('"+sol[i]+"')";
			var code_font='';
			if(sol[i]==id_select_iteract){
				if(nom_lab!='empty'){
					coul_cercle='white';
					coul_texte='black';
				}else{
					coul_cercle='white';
					coul_texte='white';
				}
			}
			code+='<circle cx="'+coord_x+'" cy="'+coord_y+'" r="'+rayon+'" stroke="black" stroke-width="3" fill="'+coul_cercle+'" onclick="'+id_fonct+'" />';
			code+='<text text-anchor="middle" dominant-baseline="central" font-weight="bold"';
			code+='font-size="'+taille_pol+'" x="'+coord_x+'" y="'+coord_y+'" fill="'+coul_texte+'" onclick="'+id_fonct+'" >'+nom_lab+'</text>';
		}
	}
	code+='</svg>';
	document.getElementById(fen).innerHTML=code;
}
function make_sol_init(){
	sol_act=[];
	var code_info='<p><b>La solution initiale à été créée</b></p>';
	var data_selection=document.getElementById('data_selection').value;
	var disposition=document.getElementById('disposition').value;
	type_grille=document.getElementById('type_grille').value;
	taille=document.getElementById('taille').value;
	if(isNaN(taille) | taille <= 0){
		code_info='<p style="color:red"><b>La taille est invalide</b></p>';
	}else{
		if(data_selection=='2' && import_input_ids=='non'){
			code_info='<p style="color:red"><b>Les données sont non valides</b></p>';
		}else{
			if(data_selection=='1'){
				input_ids=copie(ex1_input_ids);
				input_ids_colors=copie(ex1_input_colors);
				input_ids_colors_base=copie(ex1_input_colors);
				input_ids_1=copie(ex1_input_ids_1);
				input_ids_2=copie(ex1_input_ids_2);
				input_weight=copie(ex1_input_weight);
			}
			if(data_selection=='2'){
				input_ids=copie(import_input_ids);
				input_ids_1=copie(import_input_ids_1);
				input_ids_2=copie(import_input_ids_2);
				input_weight=copie(import_input_weight);
				input_ids_colors=[];
				for(var i=0;i<input_ids.length;i++){
					input_ids_colors.push('blue');
					input_ids_colors_base.push('blue');
				}
			}
			grille=gen_balles();
			var nb_tot=grille[1].length;
			var nb_lab=input_ids.length;
			rayon_unit=grille[0];
			if(disposition=='1'){
				var compteur=1;
				for(var i=0;i<nb_tot;i++){
					if(i<nb_lab){
						sol_act.push(input_ids[i]);
					}else{
						sol_act.push('empty_'+compteur);
						compteur+=1;
					}
				}
				sol_act=shuffle(sol_act);
			}
			if(disposition=='2'){
				var compteur=1;
				for(var i=0;i<nb_tot;i++){
					if(i<nb_lab){
						sol_act.push(input_ids[i]);
					}else{
						sol_act.push('empty_'+compteur);
						compteur+=1;
					}
				}
			}
			if(disposition=='3'){
				var input_ids_shu=shuffle(input_ids);
				for(var i=0;i<nb_tot;i++){
					sol_act.push('empty');
				}
				for(var j=0;j<nb_lab;j++){
					var score=1000;
					var indice=0;
					for(var k=0;k<nb_tot;k++){
						if(sol_act[k]=='empty'){
							var dist=Math.sqrt((grille[1][k]-0.5)*(grille[1][k]-0.5)+(grille[2][k]-0.5)*(grille[2][k]-0.5));
							if(dist<score){
								score=dist;
								indice=k;
							}
						}
					}
					sol_act[indice]=input_ids_shu[j];
				}
				var compteur=1;
				for(var t=0;t<nb_tot;t++){
					if(sol_act[t]=='empty'){
						sol_act[t]='empty_'+compteur;
						compteur+=1;
					}
				}
			}
			if(disposition=='4'){
				for(var i=0;i<nb_tot;i++){
					sol_act.push('empty');
				}
				for(var j=0;j<nb_lab;j++){
					var indice=0;
					var score=1000;
					for(var k=0;k<nb_tot;k++){
						if(sol_act[k]=='empty'){
							var dist=Math.sqrt((grille[1][k]-0.5)*(grille[1][k]-0.5)+(grille[2][k]-0.5)*(grille[2][k]-0.5));
							if(dist<score){
								score=dist;
								indice=k;
							}
						}
					}
					sol_act[indice]=input_ids[j];
				}
				var compteur=1;
				for(var t=0;t<nb_tot;t++){
					if(sol_act[t]=='empty'){
						sol_act[t]='empty_'+compteur;
						compteur+=1;
					}
				}
			}
			if(disposition=='5'){
				var input_ids_shu=shuffle(input_ids);
				for(var i=0;i<nb_tot;i++){
					sol_act.push('empty');
				}
				for(var j=0;j<nb_lab;j++){
					var score=0;
					var indice=0;
					for(var k=0;k<nb_tot;k++){
						if(sol_act[k]=='empty'){
							var dist=Math.sqrt((grille[1][k]-0.5)*(grille[1][k]-0.5)+(grille[2][k]-0.5)*(grille[2][k]-0.5));
							if(dist>score){
								score=dist;
								indice=k;
							}
						}
					}
					sol_act[indice]=input_ids_shu[j];
				}
				var compteur=1;
				for(var t=0;t<nb_tot;t++){
					if(sol_act[t]=='empty'){
						sol_act[t]='empty_'+compteur;
						compteur+=1;
					}
				}
			}
			if(disposition=='6'){
				for(var i=0;i<nb_tot;i++){
					sol_act.push('empty');
				}
				for(var j=0;j<nb_lab;j++){
					var indice=0;
					var score=0;
					for(var k=0;k<nb_tot;k++){
						if(sol_act[k]=='empty'){
							var dist=Math.sqrt((grille[1][k]-0.5)*(grille[1][k]-0.5)+(grille[2][k]-0.5)*(grille[2][k]-0.5));
							if(dist>score){
								score=dist;
								indice=k;
							}
						}
					}
					sol_act[indice]=input_ids[j];
				}
				var compteur=1;
				for(var t=0;t<nb_tot;t++){
					if(sol_act[t]=='empty'){
						sol_act[t]='empty_'+compteur;
						compteur+=1;
					}
				}
			}
			var clientHeight = document.getElementById('solution_actuelle').clientHeight;
			var clientWidth = document.getElementById('solution_actuelle').clientWidth;
			taille_svg=0.7*Math.min(clientHeight,clientWidth);
			rayon=rayon_unit*taille_svg;
			if(type_grille=='ligne'){
				taille_pol=taille_police('XXXXX',1.65*0.8*rayon);
			}else{
				taille_pol=taille_police('XXXXX',1.65*rayon);
			}
			matrice_distance=poids_to_dist();
			eva_sol_act=evaluation(sol_act);
			idefix=[];
			visualize(sol_act,eva_sol_act,'solution_actuelle');
			sol_init_yesno=1;
			id_select_iteract='non';
			affichage();
		}
	}
	document.getElementById('informations').innerHTML=code_info;
}
function voisinage(solution){
	var voisins=[];
	voisins.push(solution);
	for(var i=0;i<solution.length;i++){
		for(var j=0;j<solution.length;j++){
			if(i<j){
				if(solution[i]!=solution[j]){
					var indice_1=idefix.indexOf(solution[i]);
					var indice_2=idefix.indexOf(solution[j]);
					if(indice_1==-1 && indice_2==-1){
						var temp=copie(solution);
						temp[i]=solution[j];
						temp[j]=solution[i];
						voisins.push(temp);
					}
				}
			}
		}
	}
	return voisins;
}
function voisinage_plus(solution){
	var voisins=[];
	var voisins_directs=voisinage(solution);
	for(var i=0;i<voisins_directs.length;i++){
		var temp=voisinage(voisins_directs[i]);
		for(var j=0;j<temp.length;j++){
			voisins.push(temp[j]);
		}
	}
	return voisins;
}
function best_solution(liste_solutions,sol_ref,eva_ref,variante){
	var best_sol=sol_ref;
	var best_eva=eva_ref;
	if(variante=='1'){
		var liste_solutions_shu=shuffle(liste_solutions);
		for(var i=0;i<liste_solutions_shu.length;i++){
			var new_sol=liste_solutions_shu[i];
			var new_eva=evaluation_opt(new_sol,sol_ref,eva_ref);
			if(new_eva<best_eva){
				best_sol=new_sol;
				best_eva=new_eva;
				break;
			}
		}
	}
	if(variante=='2'){
		for(var i=0;i<liste_solutions.length;i++){
			var new_sol=liste_solutions[i];
			var new_eva=evaluation_opt(new_sol,sol_ref,eva_ref);
			if(new_eva<best_eva){
				best_sol=new_sol;
				best_eva=new_eva;
			}
		}
	}
	return [best_sol,best_eva];
}
function optimize(){
	optimize_yesno=1;
	affichage();
	var variante=document.getElementById('variante').value;
	var kmax=10000;
	var k=1;
	boucle=setInterval(function(){
		var temperature=document.getElementById('temperature').value;
		var rand=Math.random();
		document.getElementById('informations').innerHTML='<p><b>Optimisation en cours<br />itération '+k+'<br />Température: '+temperature*100+'</b></p>';
		var voisins=voisinage(sol_act);
		if(rand<temperature){
			var rand_indice=Math.floor(Math.random()*voisins.length)
			var new_sol=voisins[rand_indice];
			var new_eva=evaluation_opt(new_sol,sol_act,eva_sol_act);
			sol_act=new_sol;
			eva_sol_act=new_eva;
		}else{
			var recherche=best_solution(voisins,sol_act,eva_sol_act,variante);
			var new_sol=recherche[0];
			var new_eva=recherche[1];
			if(new_eva<eva_sol_act){
				sol_act=new_sol;
				eva_sol_act=new_eva;
			}
		}
		k=k+1;
		visualize(sol_act,eva_sol_act,'solution_actuelle');
	}, 100);
}
function stop_opt(){
	clearInterval(boucle);
	optimize_yesno=0;
	affichage();
}
function visualLength(text,pol){
    var ruler=document.getElementById('ruler');
    ruler.innerHTML=text;
	ruler.style.fontSize=pol;
    return ruler.offsetWidth;
}
function taille_police(text,max){
	var pol=24;
	var taille=visualLength(text,pol);
	while(taille>max){
		pol=pol-1;
		taille=visualLength(text,pol);
	}
    return pol;
}
function change_click(id){
	var mode_selection=document.getElementById('mode_selection').value;
	if(mode_selection=='bleu'){
		if(id!='empty'){
			var indice=input_ids.indexOf(id);
			if(indice!=-1){
				if(input_ids_colors[indice]!='blue'){
					input_ids_colors[indice]='blue';
				}
				else{
					input_ids_colors[indice]=input_ids_colors_base[indice];
				}
			}
		}
	}
	if(mode_selection=='rouge'){
		if(id!='empty'){
			var indice=input_ids.indexOf(id);
			if(indice!=-1){
				if(input_ids_colors[indice]!='red'){
					input_ids_colors[indice]='red';
				}
				else{
					input_ids_colors[indice]=input_ids_colors_base[indice];
				}
			}
		}
	}
	if(mode_selection=='vert'){
		if(id!='empty'){
			var indice=input_ids.indexOf(id);
			if(indice!=-1){
				if(input_ids_colors[indice]!='green'){
					input_ids_colors[indice]='green';
				}
				else{
					input_ids_colors[indice]=input_ids_colors_base[indice];
				}
			}
		}
	}
	if(mode_selection=='violet'){
		if(id!='empty'){
			var indice=input_ids.indexOf(id);
			if(indice!=-1){
				if(input_ids_colors[indice]!='purple'){
					input_ids_colors[indice]='purple';
				}
				else{
					input_ids_colors[indice]=input_ids_colors_base[indice];
				}
			}
		}
	}
	if(mode_selection=='changement'){
		if(id_select_iteract=='non'){
			id_select_iteract=id;
		}else{
			var indice_1=sol_act.indexOf(id_select_iteract);
			var indice_2=sol_act.indexOf(id);
			sol_act[indice_1]=id;
			sol_act[indice_2]=id_select_iteract;
			id_select_iteract='non';
		}
	}
	if(mode_selection=='fixe'){
		if(id!='empty'){
			var indice=idefix.indexOf(id);
			if(indice!=-1){
				idefix.splice(indice,1);
			}else{
				idefix.push(id);
			}
		}
	}
	visualize(sol_act,eva_sol_act,'solution_actuelle');
}
function affichage(){
	if(optimize_yesno==1){
		document.getElementById('init_algo').disabled=true;
	}else{
		document.getElementById('init_algo').disabled=false;
	}
	if(sol_init_yesno==0 || optimize_yesno==1){
		document.getElementById('start_algo').disabled=true;
	}else{
		document.getElementById('start_algo').disabled=false;
	}
	if(optimize_yesno==0){
		document.getElementById('stop_algo').disabled=true;
	}else{
		document.getElementById('stop_algo').disabled=false;
	}
}
affichage();
</script>
</html>