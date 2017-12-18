<?php
/**
 * 語言檔
 * */

class MyLang
{
  var $g_myLangArr;

  function MyLang()
  {
  	echo "$pageName";
    global $g_myLangArr;
    $this->g_myLangArr = $g_myLangArr;
  }

  /**
   * 取得該 html 頁的語系檔
   * @param $pageName
   *     */
  function getLangArr($pageName = "")
  {
    $reArr = array();

    switch($pageName)
	{
		// -------------------------------------------------------------------------
		// index 首頁
		// -------------------------------------------------------------------------
		case "index" :
			$reArr["G_lang_SLG"] = $this->g_myLangArr["SLG"]; // 打造您的專屬競爭力
			$reArr["G_lang_Our_Customer"] = $this->g_myLangArr["Our_Customer"]; // 我們的客戶
			$reArr["G_lang_OurCustomer"] = $this->g_myLangArr["OurCustomer"]; // Our Customer
			$reArr["G_lang_Product_and_Service"] = $this->g_myLangArr["Product_and_Service"]; // 產品與服務
			$reArr["G_lang_ProductandService"] = $this->g_myLangArr["ProductandService"]; // Product and Service
			$reArr["G_lang_PnS_Title_1"] = $this->g_myLangArr["PnS_Title_1"]; // 物流諮詢與規劃
			$reArr["G_lang_PnS_Title_2"] = $this->g_myLangArr["PnS_Title_2"]; // 物流集成
			$reArr["G_lang_PnS_Title_3"] = $this->g_myLangArr["PnS_Title_3"]; // 物流軟件
			$reArr["G_lang_PnS_Title_4"] = $this->g_myLangArr["PnS_Title_4"]; // 物流設備
			$reArr["G_lang_PnS_Desc_1"] = $this->g_myLangArr["PnS_Desc_1"]; // 耀欣顧問團隊擁有近百個多業態的成功諮詢案例，具有國際領先的設計理念及本土化的服務經驗。
			$reArr["G_lang_PnS_Desc_2"] = $this->g_myLangArr["PnS_Desc_2"]; // 耀欣團隊將專業地集成整個物流系統並提供相關技術服務，從物流中心建築藍圖至正式運行，提供全方位的綜合服務。
			$reArr["G_lang_PnS_Desc_3"] = $this->g_myLangArr["PnS_Desc_3"]; // 以先進的物件導向參數化IT技術，結合豐富的物流知識，整合出高度智能化的WMS系統。
			$reArr["G_lang_PnS_Desc_4"] = $this->g_myLangArr["PnS_Desc_4"]; // 以揀貨效率為導向，利用CAN Bus雙向傳輸技術，設計出具有多國專利的智能型電子標籤。
			$reArr["G_lang_PnS_Desc_5"] = $this->g_myLangArr["PnS_Desc_5"]; // AWMS為物聯網發展趨勢而生，依據您的業態與管理模式，靈活配置與組合，快速響應市場變化。
			$reArr["G_lang_Industry_Solutions"] = $this->g_myLangArr["Industry_Solutions"]; // 行業解決方案
			$reArr["G_lang_IndustrySolutions"] = $this->g_myLangArr["IndustrySolutions"]; // Industry Solutions
			$reArr["G_lang_Indifity_Title_tw_1"] = $this->g_myLangArr["Indifity_Title_tw_1"]; // 冷鏈
			$reArr["G_lang_Indifity_Title_en_1"] = $this->g_myLangArr["Indifity_Title_en_1"]; // Cold Chain Logistics
			$reArr["G_lang_Indifity_Title_tw_2"] = $this->g_myLangArr["Indifity_Title_tw_2"]; // 量販通路
			$reArr["G_lang_Indifity_Title_en_2"] = $this->g_myLangArr["Indifity_Title_en_2"]; // Hypermarkets
			$reArr["G_lang_Indifity_Title_tw_3"] = $this->g_myLangArr["Indifity_Title_tw_3"]; // 電子商務
			$reArr["G_lang_Indifity_Title_en_3"] = $this->g_myLangArr["Indifity_Title_en_3"]; // E-commerce
			$reArr["G_lang_Indifity_Title_tw_4"] = $this->g_myLangArr["Indifity_Title_tw_4"]; // 圖書發行與出版
			$reArr["G_lang_Indifity_Title_en_4"] = $this->g_myLangArr["Indifity_Title_en_4"]; // Book publishing
			$reArr["G_lang_Indifity_Title_tw_5"] = $this->g_myLangArr["Indifity_Title_tw_5"]; // 第三方物流
			$reArr["G_lang_Indifity_Title_en_5"] = $this->g_myLangArr["Indifity_Title_en_5"]; // Third Party Logistics
			$reArr["G_lang_Indifity_Title_tw_6"] = $this->g_myLangArr["Indifity_Title_tw_6"]; // 電子與汽配
			$reArr["G_lang_Indifity_Title_en_6"] = $this->g_myLangArr["Indifity_Title_en_6"]; // Electronics & Auto Parts
			$reArr["G_lang_Indifity_Title_tw_7"] = $this->g_myLangArr["Indifity_Title_tw_7"]; // 醫療與醫材體系
			$reArr["G_lang_Indifity_Title_en_7"] = $this->g_myLangArr["Indifity_Title_en_7"]; // Health and medical
			$reArr["G_lang_Indifity_Title_tw_8"] = $this->g_myLangArr["Indifity_Title_tw_8"]; // 服飾鞋包業
			$reArr["G_lang_Indifity_Title_en_8"] = $this->g_myLangArr["Indifity_Title_en_8"]; // Fashion Industry
			$reArr["G_lang_Indifity_Desc_1"] = $this->g_myLangArr["Indifity_Desc_1"]; // 冷鏈物流一項複雜的低溫系統工程，須確保各環節的品質安全，避免出現斷鏈，導致食品損耗。
			$reArr["G_lang_Indifity_Desc_2"] = $this->g_myLangArr["Indifity_Desc_2"]; // 量販業於各地銷售狀況不一並存在多種商業模式。供應商多，統一配送率低，並存在促銷等影響出貨量的活動。
			$reArr["G_lang_Indifity_Desc_3"] = $this->g_myLangArr["Indifity_Desc_3"]; // 電子商務客戶訂單散、多、小且供應商品種類多，撿貨集貨的難度數倍的增長，揀選效率及配送效率尤為重要。
			$reArr["G_lang_Indifity_Desc_4"] = $this->g_myLangArr["Indifity_Desc_4"]; // 出版業少樣多量、圖書業多樣少量、期刊類時效性要求高，退貨品項多，如何能快速因應市場需求。
			$reArr["G_lang_Indifity_Desc_5"] = $this->g_myLangArr["Indifity_Desc_5"]; // 第三方物流需能快速響應市場需求，多樣化商品庫存管控，多種計價方式，並能處理多種訂單類型訂單模式。
			$reArr["G_lang_Indifity_Desc_6"] = $this->g_myLangArr["Indifity_Desc_6"]; // 汽車物流從存貨控制中降低成本，講求及時來料生產，必須快速將訊息回傳給供應鏈成員。
			$reArr["G_lang_Indifity_Desc_7"] = $this->g_myLangArr["Indifity_Desc_7"]; // 醫療體系需依各國衛生機關法規嚴格控管藥品。藥品進行批號校期控管及批號流向追蹤是管理核心重點。
			$reArr["G_lang_Indifity_Desc_8"] = $this->g_myLangArr["Indifity_Desc_8"]; // 時尚產業多樣少量，短暫的流行週期特性，還有同款多色、多碼等，使得物流作業增添困難性。
			$reArr["G_lang_AboutUs_Title_1"] = $this->g_myLangArr["AboutUs_Title_1"]; // 耀欣簡介
			$reArr["G_lang_AboutUs_Title_2"] = $this->g_myLangArr["AboutUs_Title_2"]; // 物流新知
			$reArr["G_lang_AboutUs_Title_3"] = $this->g_myLangArr["AboutUs_Title_3"]; // 新聞動態
			$reArr["G_lang_AboutUs_Title_4"] = $this->g_myLangArr["AboutUs_Title_4"]; // 顧問團隊
			$reArr["G_lang_AboutUs_Title_5"] = $this->g_myLangArr["AboutUs_Title_5"]; // 專利及技術認證
			$reArr["G_lang_AboutUs_Title_6"] = $this->g_myLangArr["AboutUs_Title_6"]; // 歷史與肯定
			$reArr["G_lang_AboutUs_Title_7"] = $this->g_myLangArr["AboutUs_Title_7"]; // 人才招募
			$reArr["G_lang_AboutUs_Title_8"] = $this->g_myLangArr["AboutUs_Title_8"]; // 聯繫我們
			$reArr["G_lang_Logistics_Title_tw"] = $this->g_myLangArr["Logistics_Title_tw"]; // 物流學院
			$reArr["G_lang_Logistics_Title_en"] = $this->g_myLangArr["Logistics_Title_en"]; // Logistics
			$reArr["G_lang_Address_1_1"] = $this->g_myLangArr["Address_1_1"]; // 桃園市
			$reArr["G_lang_Address_1_2"] = $this->g_myLangArr["Address_1_2"]; // 春日路1000巷8弄28號
			$reArr["G_lang_Address_2_1"] = $this->g_myLangArr["Address_1_1"]; // 上海市
			$reArr["G_lang_Address_2_2"] = $this->g_myLangArr["Address_1_2"]; // 虹口區歐陽路196號10樓418室
			$reArr["G_lang_Foot_Link_Title_1"] = $this->g_myLangArr["Foot_Link_Title_1"]; // 我們的客戶
			$reArr["G_lang_Foot_Link_Title_2"] = $this->g_myLangArr["Foot_Link_Title_2"]; // 產品與服務
			$reArr["G_lang_Foot_Link_Title_3"] = $this->g_myLangArr["Foot_Link_Title_3"]; // 行業解決方案
			$reArr["G_lang_Foot_Link_Title_4"] = $this->g_myLangArr["Foot_Link_Title_4"]; // 關於耀欣
			$reArr["G_lang_Foot_Link_Title_5"] = $this->g_myLangArr["Foot_Link_Title_5"]; // 物流學院
			$reArr["G_lang_Foot_Link_1_1"] = $this->g_myLangArr["Foot_Link_1_1"]; // 冷鏈
			$reArr["G_lang_Foot_Link_1_2"] = $this->g_myLangArr["Foot_Link_1_2"]; // 量販通路
			$reArr["G_lang_Foot_Link_1_3"] = $this->g_myLangArr["Foot_Link_1_3"]; // 電子商務
			$reArr["G_lang_Foot_Link_1_4"] = $this->g_myLangArr["Foot_Link_1_4"]; // 圖書發行與出版
			$reArr["G_lang_Foot_Link_1_5"] = $this->g_myLangArr["Foot_Link_1_5"]; // 第三方物流
			$reArr["G_lang_Foot_Link_1_6"] = $this->g_myLangArr["Foot_Link_1_6"]; // 電子與汽配
			$reArr["G_lang_Foot_Link_1_7"] = $this->g_myLangArr["Foot_Link_1_7"]; // 醫療與醫材體系
			$reArr["G_lang_Foot_Link_1_8"] = $this->g_myLangArr["Foot_Link_1_8"]; // 服飾鞋包業
			$reArr["G_lang_Foot_Link_1_9"] = $this->g_myLangArr["Foot_Link_1_9"]; // 其他
			$reArr["G_lang_Foot_Link_2_1"] = $this->g_myLangArr["Foot_Link_2_1"]; // 物流諮詢與規劃
			$reArr["G_lang_Foot_Link_2_2"] = $this->g_myLangArr["Foot_Link_2_2"]; // 物流集成
			$reArr["G_lang_Foot_Link_2_3"] = $this->g_myLangArr["Foot_Link_2_3"]; // 物流軟件
			$reArr["G_lang_Foot_Link_2_4"] = $this->g_myLangArr["Foot_Link_2_4"]; // 物流設備
			$reArr["G_lang_Foot_Link_3_1"] = $this->g_myLangArr["Foot_Link_3_1"]; // 冷鏈
			$reArr["G_lang_Foot_Link_3_2"] = $this->g_myLangArr["Foot_Link_3_2"]; // 量販通路
			$reArr["G_lang_Foot_Link_3_3"] = $this->g_myLangArr["Foot_Link_3_3"]; // 電子商務
			$reArr["G_lang_Foot_Link_3_4"] = $this->g_myLangArr["Foot_Link_3_4"]; // 圖書發行與出版
			$reArr["G_lang_Foot_Link_3_5"] = $this->g_myLangArr["Foot_Link_3_5"]; // 第三方物流
			$reArr["G_lang_Foot_Link_3_6"] = $this->g_myLangArr["Foot_Link_3_6"]; // 電子與汽配
			$reArr["G_lang_Foot_Link_3_7"] = $this->g_myLangArr["Foot_Link_3_7"]; // 醫療與醫材體系
			$reArr["G_lang_Foot_Link_3_8"] = $this->g_myLangArr["Foot_Link_3_8"]; // 服飾鞋包業
			$reArr["G_lang_Foot_Link_4_1"] = $this->g_myLangArr["Foot_Link_4_1"]; // 耀欣簡介
			$reArr["G_lang_Foot_Link_4_2"] = $this->g_myLangArr["Foot_Link_4_2"]; // 物流新知
			$reArr["G_lang_Foot_Link_4_3"] = $this->g_myLangArr["Foot_Link_4_3"]; // 新聞動態
			$reArr["G_lang_Foot_Link_4_4"] = $this->g_myLangArr["Foot_Link_4_4"]; // 團隊顧問
			$reArr["G_lang_Foot_Link_4_5"] = $this->g_myLangArr["Foot_Link_4_5"]; // 專利及技術認證
			$reArr["G_lang_Foot_Link_4_6"] = $this->g_myLangArr["Foot_Link_4_6"]; // 歷史與肯定
			$reArr["G_lang_Foot_Link_4_7"] = $this->g_myLangArr["Foot_Link_4_7"]; // 人才招募
			$reArr["G_lang_Foot_Link_4_8"] = $this->g_myLangArr["Foot_Link_4_8"]; // 聯繫我們
			$reArr["G_lang_Right_Tooltips_1"] = $this->g_myLangArr["Right_Tooltips_1"]; // 首頁
			$reArr["G_lang_Right_Tooltips_2"] = $this->g_myLangArr["Right_Tooltips_2"]; // 最新消息
			$reArr["G_lang_Right_Tooltips_3"] = $this->g_myLangArr["Right_Tooltips_3"]; // 我們的客戶
			$reArr["G_lang_Right_Tooltips_4"] = $this->g_myLangArr["Right_Tooltips_4"]; // 產品與服務
			$reArr["G_lang_Right_Tooltips_5"] = $this->g_myLangArr["Right_Tooltips_5"]; // 行業解決方案
			$reArr["G_lang_Right_Tooltips_6"] = $this->g_myLangArr["Right_Tooltips_6"]; // 關於耀欣
			$reArr["G_lang_Right_Tooltips_7"] = $this->g_myLangArr["Right_Tooltips_7"]; // 物流學院

			break;

		// -------------------------------------------------------------------------
		// 我們的客戶
		// -------------------------------------------------------------------------
		case "Customer" :
		    $reArr["G_lang_Customer_Title_tw"] = $this->g_myLangArr["Customer_Title_tw"]; //我們的客戶
		    $reArr["G_lang_Customer_Title_en"] = $this->g_myLangArr["Customer_Title_en"]; //Our Customer
		break;
		case "Customer_detail" :
		    $reArr["G_lang_Customer_Title_tw"] = $this->g_myLangArr["Customer_Title_tw"]; //我們的客戶
		    $reArr["G_lang_Customer_Title_en"] = $this->g_myLangArr["Customer_Title_en"]; //Our Customer
		break;

		// -------------------------------------------------------------------------
		// 產品與服務
		// -------------------------------------------------------------------------
		case "PndS_01" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
			$reArr["G_lang_PndS_Word_04"] = $this->g_myLangArr["PndS_Word_04"]; //
			$reArr["G_lang_PndS_Word_05"] = $this->g_myLangArr["PndS_Word_05"]; //
			$reArr["G_lang_PndS_Word_06"] = $this->g_myLangArr["PndS_Word_06"]; //
			$reArr["G_lang_PndS_Word_07"] = $this->g_myLangArr["PndS_Word_07"]; //
			$reArr["G_lang_PndS_Word_08"] = $this->g_myLangArr["PndS_Word_08"]; //
			$reArr["G_lang_PndS_Word_09"] = $this->g_myLangArr["PndS_Word_09"]; //
			$reArr["G_lang_PndS_Word_10"] = $this->g_myLangArr["PndS_Word_10"]; //
			$reArr["G_lang_PndS_Word_11"] = $this->g_myLangArr["PndS_Word_11"]; //
			$reArr["G_lang_PndS_Word_12"] = $this->g_myLangArr["PndS_Word_12"]; //
			$reArr["G_lang_PndS_Word_13"] = $this->g_myLangArr["PndS_Word_13"]; //
			$reArr["G_lang_PndS_Word_14"] = $this->g_myLangArr["PndS_Word_14"]; //
			$reArr["G_lang_PndS_Word_15"] = $this->g_myLangArr["PndS_Word_15"]; //
			$reArr["G_lang_PndS_Word_16"] = $this->g_myLangArr["PndS_Word_16"]; //
			$reArr["G_lang_PndS_Word_17"] = $this->g_myLangArr["PndS_Word_17"]; //
			$reArr["G_lang_PndS_Word_18"] = $this->g_myLangArr["PndS_Word_18"]; //
			$reArr["G_lang_PndS_Word_19"] = $this->g_myLangArr["PndS_Word_19"]; //
			$reArr["G_lang_PndS_Word_20"] = $this->g_myLangArr["PndS_Word_20"]; //
			$reArr["G_lang_PndS_Word_21"] = $this->g_myLangArr["PndS_Word_21"]; //
			$reArr["G_lang_PndS_Word_22"] = $this->g_myLangArr["PndS_Word_22"]; //
			$reArr["G_lang_PndS_Word_23"] = $this->g_myLangArr["PndS_Word_23"]; //
			$reArr["G_lang_PndS_Word_24"] = $this->g_myLangArr["PndS_Word_24"]; //
			$reArr["G_lang_PndS_Word_25"] = $this->g_myLangArr["PndS_Word_25"]; //
			$reArr["G_lang_PndS_Word_26"] = $this->g_myLangArr["PndS_Word_26"]; //
			$reArr["G_lang_PndS_Word_27"] = $this->g_myLangArr["PndS_Word_27"]; //
		break;

		case "PndS_02" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
			$reArr["G_lang_PndS_Word_04"] = $this->g_myLangArr["PndS_Word_04"]; //
			$reArr["G_lang_PndS_Word_05"] = $this->g_myLangArr["PndS_Word_05"]; //
			$reArr["G_lang_PndS_Word_06"] = $this->g_myLangArr["PndS_Word_06"]; //
			$reArr["G_lang_PndS_Word_07"] = $this->g_myLangArr["PndS_Word_07"]; //
			$reArr["G_lang_PndS_Word_08"] = $this->g_myLangArr["PndS_Word_08"]; //
			$reArr["G_lang_PndS_Word_09"] = $this->g_myLangArr["PndS_Word_09"]; //
			$reArr["G_lang_PndS_Word_10"] = $this->g_myLangArr["PndS_Word_10"]; //
			$reArr["G_lang_PndS_Word_11"] = $this->g_myLangArr["PndS_Word_11"]; //
			$reArr["G_lang_PndS_Word_12"] = $this->g_myLangArr["PndS_Word_12"]; //
			$reArr["G_lang_PndS_Word_13"] = $this->g_myLangArr["PndS_Word_13"]; //
			$reArr["G_lang_PndS_Word_14"] = $this->g_myLangArr["PndS_Word_14"]; //
			$reArr["G_lang_PndS_Word_15"] = $this->g_myLangArr["PndS_Word_15"]; //
			$reArr["G_lang_PndS_Word_16"] = $this->g_myLangArr["PndS_Word_16"]; //
		break;

		case "PndS_03_01" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_03_Menu_1"] = $this->g_myLangArr["PndS_03_Menu_1"]; //
			$reArr["G_lang_PndS_03_Menu_2"] = $this->g_myLangArr["PndS_03_Menu_2"]; //
			$reArr["G_lang_PndS_03_Menu_3"] = $this->g_myLangArr["PndS_03_Menu_3"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
		break;

		case "PndS_03_02" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_03_Menu_1"] = $this->g_myLangArr["PndS_03_Menu_1"]; //
			$reArr["G_lang_PndS_03_Menu_2"] = $this->g_myLangArr["PndS_03_Menu_2"]; //
			$reArr["G_lang_PndS_03_Menu_3"] = $this->g_myLangArr["PndS_03_Menu_3"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
		break;

		case "PndS_03_03" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_03_Menu_1"] = $this->g_myLangArr["PndS_03_Menu_1"]; //
			$reArr["G_lang_PndS_03_Menu_2"] = $this->g_myLangArr["PndS_03_Menu_2"]; //
			$reArr["G_lang_PndS_03_Menu_3"] = $this->g_myLangArr["PndS_03_Menu_3"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
			$reArr["G_lang_PndS_Word_04"] = $this->g_myLangArr["PndS_Word_04"]; //
			$reArr["G_lang_PndS_Word_05"] = $this->g_myLangArr["PndS_Word_05"]; //
			$reArr["G_lang_PndS_Word_06"] = $this->g_myLangArr["PndS_Word_06"]; //
			$reArr["G_lang_PndS_Word_07"] = $this->g_myLangArr["PndS_Word_07"]; //
			$reArr["G_lang_PndS_Word_08"] = $this->g_myLangArr["PndS_Word_08"]; //
			$reArr["G_lang_PndS_Word_09"] = $this->g_myLangArr["PndS_Word_09"]; //
			$reArr["G_lang_PndS_Word_10"] = $this->g_myLangArr["PndS_Word_10"]; //
			$reArr["G_lang_PndS_Word_11"] = $this->g_myLangArr["PndS_Word_11"]; //
			$reArr["G_lang_PndS_Word_12"] = $this->g_myLangArr["PndS_Word_12"]; //
			$reArr["G_lang_PndS_Word_13"] = $this->g_myLangArr["PndS_Word_13"]; //
			$reArr["G_lang_PndS_Word_14"] = $this->g_myLangArr["PndS_Word_14"]; //
			$reArr["G_lang_PndS_Word_15"] = $this->g_myLangArr["PndS_Word_15"]; //
			$reArr["G_lang_PndS_Word_16"] = $this->g_myLangArr["PndS_Word_16"]; //
			$reArr["G_lang_PndS_Word_17"] = $this->g_myLangArr["PndS_Word_17"]; //
			$reArr["G_lang_PndS_Word_18"] = $this->g_myLangArr["PndS_Word_18"]; //
			$reArr["G_lang_PndS_Word_19"] = $this->g_myLangArr["PndS_Word_19"]; //
		break;

		case "PndS_04" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
			$reArr["G_lang_PndS_Word_04"] = $this->g_myLangArr["PndS_Word_04"]; //
			$reArr["G_lang_PndS_Word_05"] = $this->g_myLangArr["PndS_Word_05"]; //
			$reArr["G_lang_PndS_Word_06"] = $this->g_myLangArr["PndS_Word_06"]; //
			$reArr["G_lang_PndS_Word_07"] = $this->g_myLangArr["PndS_Word_07"]; //
			$reArr["G_lang_PndS_Word_08"] = $this->g_myLangArr["PndS_Word_08"]; //
			$reArr["G_lang_PndS_Word_09"] = $this->g_myLangArr["PndS_Word_09"]; //
			$reArr["G_lang_PndS_Word_10"] = $this->g_myLangArr["PndS_Word_10"]; //
			$reArr["G_lang_PndS_Word_11"] = $this->g_myLangArr["PndS_Word_11"]; //
			$reArr["G_lang_PndS_Word_12"] = $this->g_myLangArr["PndS_Word_12"]; //
		break;

		case "PndS_05" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
			$reArr["G_lang_PndS_Word_04"] = $this->g_myLangArr["PndS_Word_04"]; //
			$reArr["G_lang_PndS_Word_05"] = $this->g_myLangArr["PndS_Word_05"]; //
		break;

		case "PndS_05_list" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
		break;

		case "PndS_05_detail" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc_1"] = $this->g_myLangArr["Banner_Desc_1"]; //
			$reArr["G_lang_Banner_Desc_2"] = $this->g_myLangArr["Banner_Desc_2"]; //
			$reArr["G_lang_PndS_Word_01"] = $this->g_myLangArr["PndS_Word_01"]; //
			$reArr["G_lang_PndS_Word_02"] = $this->g_myLangArr["PndS_Word_02"]; //
			$reArr["G_lang_PndS_Word_03"] = $this->g_myLangArr["PndS_Word_03"]; //
			$reArr["G_lang_PndS_Word_04"] = $this->g_myLangArr["PndS_Word_04"]; //
		break;


		// -------------------------------------------------------------------------
		// 行業解決方案
		// -------------------------------------------------------------------------
		case "Indifity_01" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
			$reArr["G_lang_IndS_Word_19"] = $this->g_myLangArr["IndS_Word_19"]; //
			$reArr["G_lang_IndS_Word_20"] = $this->g_myLangArr["IndS_Word_20"]; //
		break;

		case "Indifity_02" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
			$reArr["G_lang_IndS_Word_19"] = $this->g_myLangArr["IndS_Word_19"]; //
			$reArr["G_lang_IndS_Word_20"] = $this->g_myLangArr["IndS_Word_20"]; //
			$reArr["G_lang_IndS_Word_21"] = $this->g_myLangArr["IndS_Word_21"]; //
			$reArr["G_lang_IndS_Word_22"] = $this->g_myLangArr["IndS_Word_22"]; //
			$reArr["G_lang_IndS_Word_23"] = $this->g_myLangArr["IndS_Word_23"]; //
			$reArr["G_lang_IndS_Word_24"] = $this->g_myLangArr["IndS_Word_24"]; //
			$reArr["G_lang_IndS_Word_25"] = $this->g_myLangArr["IndS_Word_25"]; //
			$reArr["G_lang_IndS_Word_26"] = $this->g_myLangArr["IndS_Word_26"]; //
			$reArr["G_lang_IndS_Word_27"] = $this->g_myLangArr["IndS_Word_27"]; //
		break;

		case "Indifity_03" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
		break;

		case "Indifity_04" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
			$reArr["G_lang_IndS_Word_19"] = $this->g_myLangArr["IndS_Word_19"]; //
			$reArr["G_lang_IndS_Word_20"] = $this->g_myLangArr["IndS_Word_20"]; //
			$reArr["G_lang_IndS_Word_21"] = $this->g_myLangArr["IndS_Word_21"]; //
			$reArr["G_lang_IndS_Word_22"] = $this->g_myLangArr["IndS_Word_22"]; //
			$reArr["G_lang_IndS_Word_23"] = $this->g_myLangArr["IndS_Word_23"]; //
			$reArr["G_lang_IndS_Word_24"] = $this->g_myLangArr["IndS_Word_24"]; //
			$reArr["G_lang_IndS_Word_25"] = $this->g_myLangArr["IndS_Word_25"]; //
			$reArr["G_lang_IndS_Word_26"] = $this->g_myLangArr["IndS_Word_26"]; //
			$reArr["G_lang_IndS_Word_27"] = $this->g_myLangArr["IndS_Word_27"]; //
			$reArr["G_lang_IndS_Word_28"] = $this->g_myLangArr["IndS_Word_28"]; //
			$reArr["G_lang_IndS_Word_29"] = $this->g_myLangArr["IndS_Word_29"]; //
			$reArr["G_lang_IndS_Word_30"] = $this->g_myLangArr["IndS_Word_30"]; //
			$reArr["G_lang_IndS_Word_31"] = $this->g_myLangArr["IndS_Word_31"]; //
			$reArr["G_lang_IndS_Word_32"] = $this->g_myLangArr["IndS_Word_32"]; //
			$reArr["G_lang_IndS_Word_33"] = $this->g_myLangArr["IndS_Word_33"]; //
			$reArr["G_lang_IndS_Word_34"] = $this->g_myLangArr["IndS_Word_34"]; //
			$reArr["G_lang_IndS_Word_35"] = $this->g_myLangArr["IndS_Word_35"]; //
			$reArr["G_lang_IndS_Word_36"] = $this->g_myLangArr["IndS_Word_36"]; //
			$reArr["G_lang_IndS_Word_37"] = $this->g_myLangArr["IndS_Word_37"]; //
			$reArr["G_lang_IndS_Word_38"] = $this->g_myLangArr["IndS_Word_38"]; //
			$reArr["G_lang_IndS_Word_39"] = $this->g_myLangArr["IndS_Word_39"]; //
			$reArr["G_lang_IndS_Word_40"] = $this->g_myLangArr["IndS_Word_40"]; //
		break;

		case "Indifity_05" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
			$reArr["G_lang_IndS_Word_19"] = $this->g_myLangArr["IndS_Word_19"]; //
			$reArr["G_lang_IndS_Word_20"] = $this->g_myLangArr["IndS_Word_20"]; //
			$reArr["G_lang_IndS_Word_21"] = $this->g_myLangArr["IndS_Word_21"]; //
			$reArr["G_lang_IndS_Word_22"] = $this->g_myLangArr["IndS_Word_22"]; //
			$reArr["G_lang_IndS_Word_23"] = $this->g_myLangArr["IndS_Word_23"]; //
			$reArr["G_lang_IndS_Word_24"] = $this->g_myLangArr["IndS_Word_24"]; //
			$reArr["G_lang_IndS_Word_25"] = $this->g_myLangArr["IndS_Word_25"]; //
			$reArr["G_lang_IndS_Word_26"] = $this->g_myLangArr["IndS_Word_26"]; //
			$reArr["G_lang_IndS_Word_27"] = $this->g_myLangArr["IndS_Word_27"]; //
			$reArr["G_lang_IndS_Word_28"] = $this->g_myLangArr["IndS_Word_28"]; //
		break;

		case "Indifity_06" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
			$reArr["G_lang_IndS_Word_19"] = $this->g_myLangArr["IndS_Word_19"]; //
			$reArr["G_lang_IndS_Word_20"] = $this->g_myLangArr["IndS_Word_20"]; //
			$reArr["G_lang_IndS_Word_21"] = $this->g_myLangArr["IndS_Word_21"]; //
			$reArr["G_lang_IndS_Word_22"] = $this->g_myLangArr["IndS_Word_22"]; //
			$reArr["G_lang_IndS_Word_23"] = $this->g_myLangArr["IndS_Word_23"]; //
			$reArr["G_lang_IndS_Word_24"] = $this->g_myLangArr["IndS_Word_24"]; //
			$reArr["G_lang_IndS_Word_25"] = $this->g_myLangArr["IndS_Word_25"]; //
			$reArr["G_lang_IndS_Word_26"] = $this->g_myLangArr["IndS_Word_26"]; //
			$reArr["G_lang_IndS_Word_27"] = $this->g_myLangArr["IndS_Word_27"]; //
			$reArr["G_lang_IndS_Word_28"] = $this->g_myLangArr["IndS_Word_28"]; //
			$reArr["G_lang_IndS_Word_29"] = $this->g_myLangArr["IndS_Word_29"]; //
			$reArr["G_lang_IndS_Word_30"] = $this->g_myLangArr["IndS_Word_30"]; //
			$reArr["G_lang_IndS_Word_31"] = $this->g_myLangArr["IndS_Word_31"]; //
			$reArr["G_lang_IndS_Word_32"] = $this->g_myLangArr["IndS_Word_32"]; //
			$reArr["G_lang_IndS_Word_33"] = $this->g_myLangArr["IndS_Word_33"]; //
			$reArr["G_lang_IndS_Word_34"] = $this->g_myLangArr["IndS_Word_34"]; //
			$reArr["G_lang_IndS_Word_35"] = $this->g_myLangArr["IndS_Word_35"]; //
		break;

		case "Indifity_07" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
			$reArr["G_lang_IndS_Word_17"] = $this->g_myLangArr["IndS_Word_17"]; //
			$reArr["G_lang_IndS_Word_18"] = $this->g_myLangArr["IndS_Word_18"]; //
			$reArr["G_lang_IndS_Word_19"] = $this->g_myLangArr["IndS_Word_19"]; //
			$reArr["G_lang_IndS_Word_20"] = $this->g_myLangArr["IndS_Word_20"]; //
			$reArr["G_lang_IndS_Word_21"] = $this->g_myLangArr["IndS_Word_21"]; //
			$reArr["G_lang_IndS_Word_22"] = $this->g_myLangArr["IndS_Word_22"]; //
			$reArr["G_lang_IndS_Word_23"] = $this->g_myLangArr["IndS_Word_23"]; //
			$reArr["G_lang_IndS_Word_24"] = $this->g_myLangArr["IndS_Word_24"]; //
			$reArr["G_lang_IndS_Word_25"] = $this->g_myLangArr["IndS_Word_25"]; //
			$reArr["G_lang_IndS_Word_26"] = $this->g_myLangArr["IndS_Word_26"]; //
			$reArr["G_lang_IndS_Word_27"] = $this->g_myLangArr["IndS_Word_27"]; //
			$reArr["G_lang_IndS_Word_28"] = $this->g_myLangArr["IndS_Word_28"]; //
		break;

		case "Indifity_08" :
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_IndS_Word_01"] = $this->g_myLangArr["IndS_Word_01"]; //
			$reArr["G_lang_IndS_Word_02"] = $this->g_myLangArr["IndS_Word_02"]; //
			$reArr["G_lang_IndS_Word_03"] = $this->g_myLangArr["IndS_Word_03"]; //
			$reArr["G_lang_IndS_Word_04"] = $this->g_myLangArr["IndS_Word_04"]; //
			$reArr["G_lang_IndS_Word_05"] = $this->g_myLangArr["IndS_Word_05"]; //
			$reArr["G_lang_IndS_Word_06"] = $this->g_myLangArr["IndS_Word_06"]; //
			$reArr["G_lang_IndS_Word_07"] = $this->g_myLangArr["IndS_Word_07"]; //
			$reArr["G_lang_IndS_Word_08"] = $this->g_myLangArr["IndS_Word_08"]; //
			$reArr["G_lang_IndS_Word_09"] = $this->g_myLangArr["IndS_Word_09"]; //
			$reArr["G_lang_IndS_Word_10"] = $this->g_myLangArr["IndS_Word_10"]; //
			$reArr["G_lang_IndS_Word_11"] = $this->g_myLangArr["IndS_Word_11"]; //
			$reArr["G_lang_IndS_Word_12"] = $this->g_myLangArr["IndS_Word_12"]; //
			$reArr["G_lang_IndS_Word_13"] = $this->g_myLangArr["IndS_Word_13"]; //
			$reArr["G_lang_IndS_Word_14"] = $this->g_myLangArr["IndS_Word_14"]; //
			$reArr["G_lang_IndS_Word_15"] = $this->g_myLangArr["IndS_Word_15"]; //
			$reArr["G_lang_IndS_Word_16"] = $this->g_myLangArr["IndS_Word_16"]; //
		break;


		// -------------------------------------------------------------------------
		// 關於耀欣
		// -------------------------------------------------------------------------
		case 'AboutUs_01':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
			$reArr["G_lang_AboutUS_Word_05"] = $this->g_myLangArr["AboutUS_Word_05"]; //
			$reArr["G_lang_AboutUS_Word_06"] = $this->g_myLangArr["AboutUS_Word_06"]; //
			$reArr["G_lang_AboutUS_Word_07"] = $this->g_myLangArr["AboutUS_Word_07"]; //
			$reArr["G_lang_AboutUS_Word_08"] = $this->g_myLangArr["AboutUS_Word_08"]; //
			$reArr["G_lang_AboutUS_Word_09"] = $this->g_myLangArr["AboutUS_Word_09"]; //
			$reArr["G_lang_AboutUS_Word_10"] = $this->g_myLangArr["AboutUS_Word_10"]; //
			$reArr["G_lang_AboutUS_Word_11"] = $this->g_myLangArr["AboutUS_Word_11"]; //
			$reArr["G_lang_AboutUS_Word_12"] = $this->g_myLangArr["AboutUS_Word_12"]; //
			$reArr["G_lang_AboutUS_Word_13"] = $this->g_myLangArr["AboutUS_Word_13"]; //
			$reArr["G_lang_AboutUS_Word_14"] = $this->g_myLangArr["AboutUS_Word_14"]; //
			$reArr["G_lang_AboutUS_Word_15"] = $this->g_myLangArr["AboutUS_Word_15"]; //
			$reArr["G_lang_AboutUS_Word_16"] = $this->g_myLangArr["AboutUS_Word_16"]; //
			$reArr["G_lang_AboutUS_Word_17"] = $this->g_myLangArr["AboutUS_Word_17"]; //
			$reArr["G_lang_AboutUS_Word_18"] = $this->g_myLangArr["AboutUS_Word_18"]; //
			$reArr["G_lang_AboutUS_Word_19"] = $this->g_myLangArr["AboutUS_Word_19"]; //
			$reArr["G_lang_AboutUS_Word_20"] = $this->g_myLangArr["AboutUS_Word_20"]; //
			$reArr["G_lang_AboutUS_Word_21"] = $this->g_myLangArr["AboutUS_Word_21"]; //
			$reArr["G_lang_AboutUS_Word_22"] = $this->g_myLangArr["AboutUS_Word_22"]; //
			$reArr["G_lang_AboutUS_Word_23"] = $this->g_myLangArr["AboutUS_Word_23"]; //
			$reArr["G_lang_AboutUS_Word_24"] = $this->g_myLangArr["AboutUS_Word_24"]; //
			$reArr["G_lang_AboutUS_Word_25"] = $this->g_myLangArr["AboutUS_Word_25"]; //
			$reArr["G_lang_AboutUS_Word_26"] = $this->g_myLangArr["AboutUS_Word_26"]; //
			$reArr["G_lang_AboutUS_Word_27"] = $this->g_myLangArr["AboutUS_Word_27"]; //
		break;

		case 'AboutUs_02':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
			$reArr["G_lang_AboutUS_Word_05"] = $this->g_myLangArr["AboutUS_Word_05"]; //
		break;

		case 'AboutUs_02_list':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
		break;

		case 'AboutUs_02_detail':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
		break;

		case 'AboutUs_03':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
		break;

		case 'AboutUs_04':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
			$reArr["G_lang_AboutUS_Word_05"] = $this->g_myLangArr["AboutUS_Word_05"]; //
			$reArr["G_lang_AboutUS_Word_06"] = $this->g_myLangArr["AboutUS_Word_06"]; //
			$reArr["G_lang_AboutUS_Word_07"] = $this->g_myLangArr["AboutUS_Word_07"]; //
			$reArr["G_lang_AboutUS_Word_08"] = $this->g_myLangArr["AboutUS_Word_08"]; //
			$reArr["G_lang_AboutUS_Word_09"] = $this->g_myLangArr["AboutUS_Word_09"]; //
			$reArr["G_lang_AboutUS_Word_10"] = $this->g_myLangArr["AboutUS_Word_10"]; //
			$reArr["G_lang_AboutUS_Word_11"] = $this->g_myLangArr["AboutUS_Word_11"]; //
			$reArr["G_lang_AboutUS_Word_12"] = $this->g_myLangArr["AboutUS_Word_12"]; //
			$reArr["G_lang_AboutUS_Word_13"] = $this->g_myLangArr["AboutUS_Word_13"]; //
			$reArr["G_lang_AboutUS_Word_14"] = $this->g_myLangArr["AboutUS_Word_14"]; //
			$reArr["G_lang_AboutUS_Word_15"] = $this->g_myLangArr["AboutUS_Word_15"]; //
			$reArr["G_lang_AboutUS_Word_16"] = $this->g_myLangArr["AboutUS_Word_16"]; //
			$reArr["G_lang_AboutUS_Word_17"] = $this->g_myLangArr["AboutUS_Word_17"]; //
			$reArr["G_lang_AboutUS_Word_18"] = $this->g_myLangArr["AboutUS_Word_18"]; //
			$reArr["G_lang_AboutUS_Word_19"] = $this->g_myLangArr["AboutUS_Word_19"]; //
			$reArr["G_lang_AboutUS_Word_20"] = $this->g_myLangArr["AboutUS_Word_20"]; //
			$reArr["G_lang_AboutUS_Word_21"] = $this->g_myLangArr["AboutUS_Word_21"]; //
			$reArr["G_lang_AboutUS_Word_22"] = $this->g_myLangArr["AboutUS_Word_22"]; //
			$reArr["G_lang_AboutUS_Word_23"] = $this->g_myLangArr["AboutUS_Word_23"]; //
			$reArr["G_lang_AboutUS_Word_24"] = $this->g_myLangArr["AboutUS_Word_24"]; //
			$reArr["G_lang_AboutUS_Word_25"] = $this->g_myLangArr["AboutUS_Word_25"]; //
			$reArr["G_lang_AboutUS_Word_26"] = $this->g_myLangArr["AboutUS_Word_26"]; //
			$reArr["G_lang_AboutUS_Word_27"] = $this->g_myLangArr["AboutUS_Word_27"]; //
			$reArr["G_lang_AboutUS_Word_28"] = $this->g_myLangArr["AboutUS_Word_28"]; //
			$reArr["G_lang_AboutUS_Word_29"] = $this->g_myLangArr["AboutUS_Word_29"]; //
			$reArr["G_lang_AboutUS_Word_30"] = $this->g_myLangArr["AboutUS_Word_30"]; //
			$reArr["G_lang_AboutUS_Word_31"] = $this->g_myLangArr["AboutUS_Word_31"]; //
			$reArr["G_lang_AboutUS_Word_32"] = $this->g_myLangArr["AboutUS_Word_32"]; //
			$reArr["G_lang_AboutUS_Word_33"] = $this->g_myLangArr["AboutUS_Word_33"]; //
			$reArr["G_lang_AboutUS_Word_34"] = $this->g_myLangArr["AboutUS_Word_34"]; //
			$reArr["G_lang_AboutUS_Word_35"] = $this->g_myLangArr["AboutUS_Word_35"]; //
			$reArr["G_lang_AboutUS_Word_36"] = $this->g_myLangArr["AboutUS_Word_36"]; //
			$reArr["G_lang_AboutUS_Word_37"] = $this->g_myLangArr["AboutUS_Word_37"]; //
			$reArr["G_lang_AboutUS_Word_38"] = $this->g_myLangArr["AboutUS_Word_38"]; //
			$reArr["G_lang_AboutUS_Word_39"] = $this->g_myLangArr["AboutUS_Word_39"]; //
			$reArr["G_lang_AboutUS_Word_40"] = $this->g_myLangArr["AboutUS_Word_40"]; //
			$reArr["G_lang_AboutUS_Word_41"] = $this->g_myLangArr["AboutUS_Word_41"]; //
			$reArr["G_lang_AboutUS_Word_42"] = $this->g_myLangArr["AboutUS_Word_42"]; //
			$reArr["G_lang_AboutUS_Word_43"] = $this->g_myLangArr["AboutUS_Word_43"]; //
			$reArr["G_lang_AboutUS_Word_44"] = $this->g_myLangArr["AboutUS_Word_44"]; //
			$reArr["G_lang_AboutUS_Word_45"] = $this->g_myLangArr["AboutUS_Word_45"]; //
			$reArr["G_lang_AboutUS_Word_46"] = $this->g_myLangArr["AboutUS_Word_46"]; //
			$reArr["G_lang_AboutUS_Word_47"] = $this->g_myLangArr["AboutUS_Word_47"]; //
			$reArr["G_lang_AboutUS_Word_48"] = $this->g_myLangArr["AboutUS_Word_48"]; //
			$reArr["G_lang_AboutUS_Word_49"] = $this->g_myLangArr["AboutUS_Word_49"]; //
			$reArr["G_lang_AboutUS_Word_50"] = $this->g_myLangArr["AboutUS_Word_50"]; //
			$reArr["G_lang_AboutUS_Word_51"] = $this->g_myLangArr["AboutUS_Word_51"]; //
			$reArr["G_lang_AboutUS_Word_52"] = $this->g_myLangArr["AboutUS_Word_52"]; //
			$reArr["G_lang_AboutUS_Word_53"] = $this->g_myLangArr["AboutUS_Word_53"]; //
			$reArr["G_lang_AboutUS_Word_54"] = $this->g_myLangArr["AboutUS_Word_54"]; //
			$reArr["G_lang_AboutUS_Word_55"] = $this->g_myLangArr["AboutUS_Word_55"]; //
			$reArr["G_lang_AboutUS_Word_56"] = $this->g_myLangArr["AboutUS_Word_56"]; //
			$reArr["G_lang_AboutUS_Word_57"] = $this->g_myLangArr["AboutUS_Word_57"]; //
			$reArr["G_lang_AboutUS_Word_58"] = $this->g_myLangArr["AboutUS_Word_58"]; //
			$reArr["G_lang_AboutUS_Word_59"] = $this->g_myLangArr["AboutUS_Word_59"]; //
			$reArr["G_lang_AboutUS_Word_60"] = $this->g_myLangArr["AboutUS_Word_60"]; //
			$reArr["G_lang_AboutUS_Word_61"] = $this->g_myLangArr["AboutUS_Word_61"]; //
			$reArr["G_lang_AboutUS_Word_62"] = $this->g_myLangArr["AboutUS_Word_62"]; //
			$reArr["G_lang_AboutUS_Word_63"] = $this->g_myLangArr["AboutUS_Word_63"]; //
			$reArr["G_lang_AboutUS_Word_64"] = $this->g_myLangArr["AboutUS_Word_64"]; //
			$reArr["G_lang_AboutUS_Word_65"] = $this->g_myLangArr["AboutUS_Word_65"]; //
			$reArr["G_lang_AboutUS_Word_66"] = $this->g_myLangArr["AboutUS_Word_66"]; //
			$reArr["G_lang_AboutUS_Word_67"] = $this->g_myLangArr["AboutUS_Word_67"]; //
			$reArr["G_lang_AboutUS_Word_68"] = $this->g_myLangArr["AboutUS_Word_68"]; //
			$reArr["G_lang_AboutUS_Word_69"] = $this->g_myLangArr["AboutUS_Word_69"]; //
			$reArr["G_lang_AboutUS_Word_70"] = $this->g_myLangArr["AboutUS_Word_70"]; //
			$reArr["G_lang_AboutUS_Word_71"] = $this->g_myLangArr["AboutUS_Word_71"]; //
			$reArr["G_lang_AboutUS_Word_72"] = $this->g_myLangArr["AboutUS_Word_72"]; //
			$reArr["G_lang_AboutUS_Word_73"] = $this->g_myLangArr["AboutUS_Word_73"]; //
			$reArr["G_lang_AboutUS_Word_74"] = $this->g_myLangArr["AboutUS_Word_74"]; //
			$reArr["G_lang_AboutUS_Word_75"] = $this->g_myLangArr["AboutUS_Word_75"]; //
			$reArr["G_lang_AboutUS_Word_76"] = $this->g_myLangArr["AboutUS_Word_76"]; //
			$reArr["G_lang_AboutUS_Word_77"] = $this->g_myLangArr["AboutUS_Word_77"]; //
			$reArr["G_lang_AboutUS_Word_78"] = $this->g_myLangArr["AboutUS_Word_78"]; //
			$reArr["G_lang_AboutUS_Word_79"] = $this->g_myLangArr["AboutUS_Word_79"]; //
			$reArr["G_lang_AboutUS_Word_80"] = $this->g_myLangArr["AboutUS_Word_80"]; //
			$reArr["G_lang_AboutUS_Word_81"] = $this->g_myLangArr["AboutUS_Word_81"]; //
			$reArr["G_lang_AboutUS_Word_82"] = $this->g_myLangArr["AboutUS_Word_82"]; //
			$reArr["G_lang_AboutUS_Word_83"] = $this->g_myLangArr["AboutUS_Word_83"]; //
			$reArr["G_lang_AboutUS_Word_84"] = $this->g_myLangArr["AboutUS_Word_84"]; //
			$reArr["G_lang_AboutUS_Word_85"] = $this->g_myLangArr["AboutUS_Word_85"]; //
			$reArr["G_lang_AboutUS_Word_86"] = $this->g_myLangArr["AboutUS_Word_86"]; //
			$reArr["G_lang_AboutUS_Word_87"] = $this->g_myLangArr["AboutUS_Word_87"]; //
			$reArr["G_lang_AboutUS_Word_88"] = $this->g_myLangArr["AboutUS_Word_88"]; //
			$reArr["G_lang_AboutUS_Word_89"] = $this->g_myLangArr["AboutUS_Word_89"]; //
			$reArr["G_lang_AboutUS_Word_90"] = $this->g_myLangArr["AboutUS_Word_90"]; //
			$reArr["G_lang_AboutUS_Word_91"] = $this->g_myLangArr["AboutUS_Word_91"]; //
			$reArr["G_lang_AboutUS_Word_92"] = $this->g_myLangArr["AboutUS_Word_92"]; //
			$reArr["G_lang_AboutUS_Word_93"] = $this->g_myLangArr["AboutUS_Word_93"]; //
			$reArr["G_lang_AboutUS_Word_94"] = $this->g_myLangArr["AboutUS_Word_94"]; //
			$reArr["G_lang_AboutUS_Word_95"] = $this->g_myLangArr["AboutUS_Word_95"]; //
		break;

		case 'AboutUs_05':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
			$reArr["G_lang_AboutUS_Word_05"] = $this->g_myLangArr["AboutUS_Word_05"]; //
			$reArr["G_lang_AboutUS_Word_06"] = $this->g_myLangArr["AboutUS_Word_06"]; //
			$reArr["G_lang_AboutUS_Word_07"] = $this->g_myLangArr["AboutUS_Word_07"]; //
			$reArr["G_lang_AboutUS_Word_08"] = $this->g_myLangArr["AboutUS_Word_08"]; //
			$reArr["G_lang_AboutUS_Word_09"] = $this->g_myLangArr["AboutUS_Word_09"]; //
			$reArr["G_lang_AboutUS_Word_10"] = $this->g_myLangArr["AboutUS_Word_10"]; //
			$reArr["G_lang_AboutUS_Word_11"] = $this->g_myLangArr["AboutUS_Word_11"]; //
			$reArr["G_lang_AboutUS_Word_12"] = $this->g_myLangArr["AboutUS_Word_12"]; //
			$reArr["G_lang_AboutUS_Word_13"] = $this->g_myLangArr["AboutUS_Word_13"]; //
			$reArr["G_lang_AboutUS_Word_14"] = $this->g_myLangArr["AboutUS_Word_14"]; //
			$reArr["G_lang_AboutUS_Word_15"] = $this->g_myLangArr["AboutUS_Word_15"]; //
			$reArr["G_lang_AboutUS_Word_16"] = $this->g_myLangArr["AboutUS_Word_16"]; //
			$reArr["G_lang_AboutUS_Word_17"] = $this->g_myLangArr["AboutUS_Word_17"]; //
			$reArr["G_lang_AboutUS_Word_18"] = $this->g_myLangArr["AboutUS_Word_18"]; //
			$reArr["G_lang_AboutUS_Word_19"] = $this->g_myLangArr["AboutUS_Word_19"]; //
			$reArr["G_lang_AboutUS_Word_20"] = $this->g_myLangArr["AboutUS_Word_20"]; //
			$reArr["G_lang_AboutUS_Word_21"] = $this->g_myLangArr["AboutUS_Word_21"]; //
			$reArr["G_lang_AboutUS_Word_22"] = $this->g_myLangArr["AboutUS_Word_22"]; //
			$reArr["G_lang_AboutUS_Word_23"] = $this->g_myLangArr["AboutUS_Word_23"]; //
			$reArr["G_lang_AboutUS_Word_24"] = $this->g_myLangArr["AboutUS_Word_24"]; //
			$reArr["G_lang_AboutUS_Word_25"] = $this->g_myLangArr["AboutUS_Word_25"]; //
			$reArr["G_lang_AboutUS_Word_26"] = $this->g_myLangArr["AboutUS_Word_26"]; //
			$reArr["G_lang_AboutUS_Word_27"] = $this->g_myLangArr["AboutUS_Word_27"]; //
			$reArr["G_lang_AboutUS_Word_28"] = $this->g_myLangArr["AboutUS_Word_28"]; //
			$reArr["G_lang_AboutUS_Word_29"] = $this->g_myLangArr["AboutUS_Word_29"]; //
			$reArr["G_lang_AboutUS_Word_30"] = $this->g_myLangArr["AboutUS_Word_30"]; //
			$reArr["G_lang_AboutUS_Word_31"] = $this->g_myLangArr["AboutUS_Word_31"]; //
			$reArr["G_lang_AboutUS_Word_32"] = $this->g_myLangArr["AboutUS_Word_32"]; //
			$reArr["G_lang_AboutUS_Word_33"] = $this->g_myLangArr["AboutUS_Word_33"]; //
			$reArr["G_lang_AboutUS_Word_34"] = $this->g_myLangArr["AboutUS_Word_34"]; //
			$reArr["G_lang_AboutUS_Word_35"] = $this->g_myLangArr["AboutUS_Word_35"]; //
			$reArr["G_lang_AboutUS_Word_36"] = $this->g_myLangArr["AboutUS_Word_36"]; //
			$reArr["G_lang_AboutUS_Word_37"] = $this->g_myLangArr["AboutUS_Word_37"]; //
			$reArr["G_lang_AboutUS_Word_38"] = $this->g_myLangArr["AboutUS_Word_38"]; //
			$reArr["G_lang_AboutUS_Word_39"] = $this->g_myLangArr["AboutUS_Word_39"]; //
			$reArr["G_lang_AboutUS_Word_40"] = $this->g_myLangArr["AboutUS_Word_40"]; //
			$reArr["G_lang_AboutUS_Word_41"] = $this->g_myLangArr["AboutUS_Word_41"]; //
			$reArr["G_lang_AboutUS_Word_42"] = $this->g_myLangArr["AboutUS_Word_42"]; //
			$reArr["G_lang_AboutUS_Word_43"] = $this->g_myLangArr["AboutUS_Word_43"]; //
			$reArr["G_lang_AboutUS_Word_44"] = $this->g_myLangArr["AboutUS_Word_44"]; //
			$reArr["G_lang_AboutUS_Word_45"] = $this->g_myLangArr["AboutUS_Word_45"]; //
			$reArr["G_lang_AboutUS_Word_46"] = $this->g_myLangArr["AboutUS_Word_46"]; //
		break;

		case 'AboutUs_06':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
		break;

		case 'AboutUs_07':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
		break;

		case 'AboutUs_08':
			$reArr["G_lang_Banner_Title_tw"] = $this->g_myLangArr["Banner_Title_tw"]; //
			$reArr["G_lang_Banner_Title_en"] = $this->g_myLangArr["Banner_Title_en"]; //
			$reArr["G_lang_Banner_Desc"] = $this->g_myLangArr["Banner_Desc"]; //
			$reArr["G_lang_AboutUS_Word_01"] = $this->g_myLangArr["AboutUS_Word_01"]; //
			$reArr["G_lang_AboutUS_Word_02"] = $this->g_myLangArr["AboutUS_Word_02"]; //
			$reArr["G_lang_AboutUS_Word_03"] = $this->g_myLangArr["AboutUS_Word_03"]; //
			$reArr["G_lang_AboutUS_Word_04"] = $this->g_myLangArr["AboutUS_Word_04"]; //
			$reArr["G_lang_AboutUS_Word_05"] = $this->g_myLangArr["AboutUS_Word_05"]; //
			$reArr["G_lang_AboutUS_Word_06"] = $this->g_myLangArr["AboutUS_Word_06"]; //
			$reArr["G_lang_AboutUS_Word_07"] = $this->g_myLangArr["AboutUS_Word_07"]; //
			$reArr["G_lang_AboutUS_Word_08"] = $this->g_myLangArr["AboutUS_Word_08"]; //
			$reArr["G_lang_AboutUS_Word_09"] = $this->g_myLangArr["AboutUS_Word_09"]; //
			$reArr["G_lang_AboutUS_Word_10"] = $this->g_myLangArr["AboutUS_Word_10"]; //
			$reArr["G_lang_AboutUS_Word_11"] = $this->g_myLangArr["AboutUS_Word_11"]; //
			$reArr["G_lang_AboutUS_Word_12"] = $this->g_myLangArr["AboutUS_Word_12"]; //
			$reArr["G_lang_AboutUS_Word_13"] = $this->g_myLangArr["AboutUS_Word_13"]; //
			$reArr["G_lang_AboutUS_Word_14"] = $this->g_myLangArr["AboutUS_Word_14"]; //
			$reArr["G_lang_AboutUS_Word_15"] = $this->g_myLangArr["AboutUS_Word_15"]; //
			$reArr["G_lang_AboutUS_Word_16"] = $this->g_myLangArr["AboutUS_Word_16"]; //
			$reArr["G_lang_AboutUS_Word_17"] = $this->g_myLangArr["AboutUS_Word_17"]; //
		break;

	}
	// -------------------------------------------------------------------------
	// 通用
	// -------------------------------------------------------------------------
    $reArr["G_lang_TopMenu_Lang_en"] = $this->g_myLangArr["TopMenu_Lang_en"]; //ENGLISH
    $reArr["G_lang_TopMenu_Lang_cn"] = $this->g_myLangArr["TopMenu_Lang_cn"]; //簡體
    $reArr["G_lang_TopMenu_Lang_tw"] = $this->g_myLangArr["TopMenu_Lang_tw"]; //繁體
    $reArr["G_lang_TopMenu_Menu"] = $this->g_myLangArr["TopMenu_Menu"]; //MENU
    $reArr["G_lang_TopMenu_CloseMenu"] = $this->g_myLangArr["TopMenu_CloseMenu"]; //MENU
    $reArr["G_lang_TopMenu_1"] = $this->g_myLangArr["TopMenu_1"]; //我們的客戶
    $reArr["G_lang_TopMenu_2"] = $this->g_myLangArr["TopMenu_2"]; //產品與服務
    $reArr["G_lang_TopMenu_3"] = $this->g_myLangArr["TopMenu_3"]; //行業解決方案
    $reArr["G_lang_TopMenu_4"] = $this->g_myLangArr["TopMenu_4"]; //關於耀欣
    $reArr["G_lang_TopMenu_5"] = $this->g_myLangArr["TopMenu_5"]; //物流學院

    $reArr["G_lang_PndSMenu_Title_tw"] = $this->g_myLangArr["PndSMenu_Title_tw"]; //產品與服務
    $reArr["G_lang_PndSMenu_Title_en"] = $this->g_myLangArr["PndSMenu_Title_en"]; //Products and Service
    $reArr["G_lang_PndSMenu_1"] = $this->g_myLangArr["PndSMenu_1"]; //物流諮詢與規劃
    $reArr["G_lang_PndSMenu_2"] = $this->g_myLangArr["PndSMenu_2"]; //物流集成
    $reArr["G_lang_PndSMenu_3"] = $this->g_myLangArr["PndSMenu_3"]; //物流軟件
    $reArr["G_lang_PndSMenu_4"] = $this->g_myLangArr["PndSMenu_4"]; //物流設備

    $reArr["G_lang_IndifityMenu_Title_tw"] = $this->g_myLangArr["IndifityMenu_Title_tw"];
    $reArr["G_lang_IndifityMenu_Title_en"] = $this->g_myLangArr["IndifityMenu_Title_en"];
    $reArr["G_lang_IndifityMenu_1"] = $this->g_myLangArr["IndifityMenu_1"];
    $reArr["G_lang_IndifityMenu_2"] = $this->g_myLangArr["IndifityMenu_2"];
    $reArr["G_lang_IndifityMenu_3"] = $this->g_myLangArr["IndifityMenu_3"];
    $reArr["G_lang_IndifityMenu_4"] = $this->g_myLangArr["IndifityMenu_4"];
    $reArr["G_lang_IndifityMenu_5"] = $this->g_myLangArr["IndifityMenu_5"];
    $reArr["G_lang_IndifityMenu_6"] = $this->g_myLangArr["IndifityMenu_6"];
    $reArr["G_lang_IndifityMenu_7"] = $this->g_myLangArr["IndifityMenu_7"];
    $reArr["G_lang_IndifityMenu_8"] = $this->g_myLangArr["IndifityMenu_8"];

    $reArr["G_lang_AboutUsMenu_Title_tw"] = $this->g_myLangArr["AboutUsMenu_Title_tw"];
    $reArr["G_lang_AboutUsMenu_Title_en"] = $this->g_myLangArr["AboutUsMenu_Title_en"];
    $reArr["G_lang_AboutUsMenu_1"] = $this->g_myLangArr["AboutUsMenu_1"];
    $reArr["G_lang_AboutUsMenu_2"] = $this->g_myLangArr["AboutUsMenu_2"];
    $reArr["G_lang_AboutUsMenu_3"] = $this->g_myLangArr["AboutUsMenu_3"];
    $reArr["G_lang_AboutUsMenu_4"] = $this->g_myLangArr["AboutUsMenu_4"];
    $reArr["G_lang_AboutUsMenu_5"] = $this->g_myLangArr["AboutUsMenu_5"];
    $reArr["G_lang_AboutUsMenu_6"] = $this->g_myLangArr["AboutUsMenu_6"];
    $reArr["G_lang_AboutUsMenu_7"] = $this->g_myLangArr["AboutUsMenu_7"];
    $reArr["G_lang_AboutUsMenu_8"] = $this->g_myLangArr["AboutUsMenu_8"];
	return $reArr;
  }
}