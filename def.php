public function defProps()
	{
		if(!CModule::IncludeModule("iblock")) return false;
		if(empty($this->iblockId)) return false;

		$prop = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("IBLOCK_ID"=>$this->iblockId));
		    while ($prop_fields = $prop->GetNext())
		    {
		    	$arPropDef[$prop_fields['CODE']] = $prop_fields['ID'];
		    }

		$originalProps = array(
			"ORIGINAL_ID" => "Оригинальный ID",
			"ORIGINAL_PRICE_BASE" => "Цена базовая",
			"ORIGINAL_PRICE" => "Цена",
			"ORIGINAL_NACENKA" => "Наценка"
			);
		foreach ($originalProps as $key => $value) {
			if(array_key_exists($key, $arPropDef) == false){
				$arFields = array();
				$arFields = array(
				     "NAME" => $value,
				     "ACTIVE" => 'Y',
				     "SORT" => 10,
				     "CODE" => $key,
				     "PROPERTY_TYPE" => 'N',
				     "IBLOCK_ID" => $this->iblockId,
				     "MULTIPLE" => "N"
				   );

				$ibp = new CIBlockProperty;
			   	$PropID = $ibp->Add($arFields);
			}
		}
	}
