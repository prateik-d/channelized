
function UpdateProvinces(url)
{
	http.open("GET", url, true);
	http.onreadystatechange = FillProvinceCombo;
	http.send(null);
}

function FillProvinceCombo() 
{
	if (http.readyState == 4) 
	{
		var json = eval('(' + http.responseText + ')'); //JSON.parse(http.responseText) is much better but that's not supported in Quirks mode.
		var combo = document.getElementById("provinceCombo");
		if (!combo)
		{
			return;
		}

		combo.options.length = 0; //clear
		var selectedId = json.selectedProvinceId;
		var selectedExists = false;
		for (var i = 0; i < json.provinces.length; i++)
		{
			var province = json.provinces[i];
			if(province.id == selectedId) {
				selectedExists = true;
			}
			combo.options[i] = new Option(province.name, province.id);
		}

		if(!selectedExists) {
			selectedId = -1;
		}
		
		combo.value = selectedId;
	}
}
