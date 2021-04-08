<?php
class ControllerExtensionModulePdfCatalog extends Controller {
	protected $error = [];
	
	public function index() {
		$this->load->language('extension/module/pdf_catalog');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		//$this->load->model('design/layout');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_pdf_catalog', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/pdf_catalog', 'user_token=' . $this->session->data['user_token'], true),
		];
		
		$data['action'] = $this->url->link('extension/module/pdf_catalog', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_pdf_catalog_status'])) {
			$data['module_pdf_catalog_status'] = $this->request->post['module_pdf_catalog_status'];
		} else {
			$data['module_pdf_catalog_status'] = $this->config->get('module_pdf_catalog_status');
		}

		if (isset($this->request->post['module_pdf_catalog_display_categories'])) {
			$data['module_pdf_catalog_display_categories'] = $this->request->post['module_pdf_catalog_display_categories'];
		} else {
			$data['module_pdf_catalog_display_categories'] = $this->config->get('module_pdf_catalog_display_categories');
		}

		if (isset($this->request->post['module_pdf_catalog_display_subcategories'])) {
			$data['module_pdf_catalog_display_subcategories'] = $this->request->post['module_pdf_catalog_display_subcategories'];
		} else {
			$data['module_pdf_catalog_display_subcategories'] = $this->config->get('module_pdf_catalog_display_subcategories');
		}

		if (isset($this->request->post['module_pdf_catalog_display_description'])) {
			$data['module_pdf_catalog_display_description'] = $this->request->post['module_pdf_catalog_display_description'];
		} else {
			$data['module_pdf_catalog_display_description'] = $this->config->get('module_pdf_catalog_display_description');
		}

		if (isset($this->request->post['module_pdf_catalog_position'])) {
			$data['module_pdf_catalog_position'] = $this->request->post['module_pdf_catalog_position'];
		} else {
			$data['module_pdf_catalog_position'] = $this->config->get('module_pdf_catalog_position');
		}

		if (isset($this->request->post['module_pdf_catalog_item_per_page'])) {
			$data['module_pdf_catalog_item_per_page'] = $this->request->post['module_pdf_catalog_item_per_page'];
		} else {
			$data['module_pdf_catalog_item_per_page'] = $this->config->get('module_pdf_catalog_item_per_page');
		}

		if (isset($this->request->post['module_pdf_catalog_image_width'])) {
			$data['module_pdf_catalog_image_width'] = $this->request->post['module_pdf_catalog_image_width'];
		} else {
			$data['module_pdf_catalog_image_width'] = $this->config->get('module_pdf_catalog_image_width');
		}

		if (isset($this->request->post['module_pdf_catalog_display_toc'])) {
			$data['module_pdf_catalog_display_toc'] = $this->request->post['module_pdf_catalog_display_toc'];
		} else {
			$data['module_pdf_catalog_display_toc'] = $this->config->get('module_pdf_catalog_display_toc');
		}

		if (isset($this->request->post['module_pdf_catalog_max_products'])) {
			$data['module_pdf_catalog_max_products'] = $this->request->post['module_pdf_catalog_max_products'];
		} else {
			$data['module_pdf_catalog_max_products'] = $this->config->get('module_pdf_catalog_max_products');
		}

		if (isset($this->request->post['module_pdf_catalog_image_height'])) {
			$data['module_pdf_catalog_image_height'] = $this->request->post['module_pdf_catalog_image_height'];
		} else {
			$data['module_pdf_catalog_image_height'] = $this->config->get('module_pdf_catalog_image_height');
		}

		if (isset($this->request->post['module_pdf_catalog_sort_order'])) {
			$data['module_pdf_catalog_sort_order'] = $this->request->post['module_pdf_catalog_sort_order'];
		} else {
			$data['module_pdf_catalog_sort_order'] = $this->config->get('module_pdf_catalog_sort_order');
		}

		if (isset($this->request->post['module_pdf_catalog_description'])) {
			$data['module_pdf_catalog_description'] = $this->request->post['module_pdf_catalog_description'];
		} else {
			$data['module_pdf_catalog_description'] = $this->config->get('module_pdf_catalog_description');
		}

		//if (isset($this->request->post['module_pdf_catalog_module'])) {
			//$data['modules'] = $this->request->post['module_pdf_catalog_module'];
		//} elseif ($this->config->get('module_pdf_catalog_module')) { 
			//$data['modules'] = $this->config->get('module_pdf_catalog_module');
		//}

		if (isset($this->request->post['module_pdf_catalog_author'])) {
			$data['module_pdf_catalog_author'] = $this->request->post['module_pdf_catalog_author'];
		} else {
			$data['module_pdf_catalog_author'] = $this->config->get('module_pdf_catalog_author');
		}		

		if (isset($this->request->post['module_pdf_catalog_title'])) {
			$data['module_pdf_catalog_title'] = $this->request->post['module_pdf_catalog_title'];
		} else {
			$data['module_pdf_catalog_title'] = $this->config->get('module_pdf_catalog_title');
		}	

		if (isset($this->request->post['module_pdf_catalog_subject'])) {
			$data['module_pdf_catalog_subject'] = $this->request->post['module_pdf_catalog_subject'];
		} else {
			$data['module_pdf_catalog_subject'] = $this->config->get('module_pdf_catalog_subject');
		}	

		if (isset($this->request->post['module_pdf_catalog_keywords'])) {
			$data['module_pdf_catalog_keywords'] = $this->request->post['module_pdf_catalog_keywords'];
		} else {
			$data['module_pdf_catalog_keywords'] = $this->config->get('module_pdf_catalog_keywords');
		}

		if (isset($this->request->post['module_pdf_catalog_description_chars'])) {
			$data['module_pdf_catalog_description_chars'] = $this->request->post['module_pdf_catalog_description_chars'];
		} else {
			$data['module_pdf_catalog_description_chars'] = $this->config->get('module_pdf_catalog_description_chars');
		}

		if (isset($this->request->post['module_pdf_catalog_template_type'])) {
			$data['module_pdf_catalog_template_type'] = $this->request->post['module_pdf_catalog_template_type'];
		} else {
			$data['module_pdf_catalog_template_type'] = $this->config->get('module_pdf_catalog_template_type');
		}

		if (isset($this->request->post['module_pdf_catalog_display_out_of_stock'])) {
			$data['module_pdf_catalog_display_out_of_stock'] = $this->request->post['module_pdf_catalog_display_out_of_stock'];
		} else {
			$data['module_pdf_catalog_display_out_of_stock'] = $this->config->get('module_pdf_catalog_display_out_of_stock');
		}

		if (isset($this->request->post['module_pdf_catalog_display_disabled'])) {
			$data['module_pdf_catalog_display_disabled'] = $this->request->post['module_pdf_catalog_display_disabled'];
		} else {
			$data['module_pdf_catalog_display_disabled'] = $this->config->get('module_pdf_catalog_display_disabled');
		}

		if (isset($this->request->post['module_pdf_catalog_sort_products'])) {
			$data['module_pdf_catalog_sort_products'] = $this->request->post['module_pdf_catalog_sort_products'];
		} else {
			$data['module_pdf_catalog_sort_products'] = $this->config->get('module_pdf_catalog_sort_products');
		}

		if (isset($this->request->post['module_pdf_catalog_max_options'])) {
			$data['module_pdf_catalog_max_options'] = $this->request->post['module_pdf_catalog_max_options'];
		} else {
			$data['module_pdf_catalog_max_options'] = $this->config->get('module_pdf_catalog_max_options');
		}

		if (isset($this->request->post['module_pdf_catalog_max_per_options'])) {
			$data['module_pdf_catalog_max_per_options'] = $this->request->post['module_pdf_catalog_max_per_options'];
		} else {
			$data['module_pdf_catalog_max_per_options'] = $this->config->get('module_pdf_catalog_max_per_options');
		}

		if (isset($this->request->post['module_pdf_catalog_display_manufacturer_name'])) {
			$data['module_pdf_catalog_display_manufacturer_name'] = $this->request->post['module_pdf_catalog_display_manufacturer_name'];
		} else {
			$data['module_pdf_catalog_display_manufacturer_name'] = $this->config->get('module_pdf_catalog_display_manufacturer_name');
		}

		if (isset($this->request->post['module_pdf_catalog_display_manufacturer_logo'])) {
			$data['module_pdf_catalog_display_manufacturer_logo'] = $this->request->post['module_pdf_catalog_display_manufacturer_logo'];
		} else {
			$data['module_pdf_catalog_display_manufacturer_logo'] = $this->config->get('module_pdf_catalog_display_manufacturer_logo');
		}

		if (isset($this->request->post['module_pdf_catalog_remove_empty_tags'])) {
			$data['module_pdf_catalog_remove_empty_tags'] = $this->request->post['module_pdf_catalog_remove_empty_tags'];
		} else {
			$data['module_pdf_catalog_remove_empty_tags'] = $this->config->get('module_pdf_catalog_remove_empty_tags');
		}

		if (isset($this->request->post['module_pdf_catalog_text_orientation'])) {
			$data['module_pdf_catalog_text_orientation'] = $this->request->post['module_pdf_catalog_text_orientation'];
		} else {
			$data['module_pdf_catalog_text_orientation'] = $this->config->get('module_pdf_catalog_text_orientation');
		}

		$data['user_token'] = $this->session->data['user_token'];
		$data['tcpdf'] = file_exists(DIR_SYSTEM . 'helper/tcpdf/tcpdf.php');
		//$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/pdf_catalog', $data));
}


	public function install() {
    	$this->load->model('setting/setting');

       	$sql="INSERT INTO " . DB_PREFIX . "setting (`store_id` ,`code` ,`key` ,`value` ,`serialized`) VALUES
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_image_height', '100', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_status', '0', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_image_width', '100', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_toc', '1', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_subcategories', '1', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_item_per_page', '6', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_max_products', '200', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_description_chars', '75', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_template_type', 'html', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_disabled', '0', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_out_of_stock', '0', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_subcategories', '1', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_sort_products', 'pd.name', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_max_options', '1', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_max_per_options', '1', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_text_orientation', 'ltr', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_manufacturer_name', '0', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_manufacturer_logo', '0', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_remove_empty_tags', '1', 0),
        	(0, 'module_pdf_catalog', 'module_pdf_catalog_display_description', '0', 0);
       ";

    	$this->db->query($sql);
	}

	public function fetch_api() {
        $this->load->model('setting/setting');

        $config_error_display = $this->config->get('config_error_display');
        $config_error_log = $this->config->get('config_error_log');

        if ( $config_error_display > 0 || $config_error_log > 0) {

            $this->model_setting_setting->editSettingValue('config', 'config_error_display', 0);
            $this->model_setting_setting->editSettingValue('config', 'config_error_log', 0);
        }

        $this->load->language('extension/module/pdf_catalog');

        $url = 'https://github.com/tecnickcom/TCPDF/archive/6.4.1.zip';
        $cache = DIR_SYSTEM . 'cache/tcpdf.zip';
        $unzip_path = DIR_SYSTEM . 'helper/';

        if (!$fp = fopen($cache, 'w')) {
            echo "Error: <br>";
            echo "You may need to change permissions for the directory $cache";
            echo '<br>';
            return;
        }

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($ch);

        curl_close($ch);

        fclose($fp);

        echo 'Download Complete....' . '<br>';

        $this->model_setting_setting->editSettingValue('config', 'config_error_display', $config_error_display);
        $this->model_setting_setting->editSettingValue('config', 'config_error_log', $config_error_log);

        if (!$fp = fopen($unzip_path.'test', 'w')) {
            echo "Error: <br>";
            echo "You may need to change permissions for the directory $unzip_path";
            echo '<br>';
        } else {
            $this->unzip($cache, $unzip_path);
            fclose($fp);
        }

        unlink($unzip_path.'test');
        //$this->rrmdir($unzip_path.'tcpdf');
        $renamed=rename(DIR_SYSTEM . 'helper/tcpdf-6.4.1',DIR_SYSTEM . 'helper/tcpdf');
        if(!$renamed == false) {
            copy(DIR_SYSTEM . 'cache/pdf_catalog_default_logo.png', DIR_SYSTEM . 'helper/tcpdf/examples/images/pdf_catalog_default_logo.png');
            //unlink($cache);
            echo 'Api Installed...';
            echo '<br>';
        } else {
            echo '<br>';
            echo '<br>';
            echo "Error: Check if Tcpdf directory exists, if it does remove it (unless you need for specific purpose).";
            echo '<br>';
        }
	}

    public function rrmdir($dir) {
        if (is_dir($dir)) {
        $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
                reset($objects);
                rmdir($dir);
        }
    }
 
    public function unzip($path,$unzip_path) {

        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo($unzip_path);
            $zip->close();
            echo "$path successfully unzipped at location:.$unzip_path";
            echo '<br>';
        } else {
            echo "Error: $path failed to unzip at location:$unzip_path";
            echo '<br>';
        }
    }

    public function uninstall() {
        $this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE 'code' = 'module_pdf_catalog' ");
    }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/pdf_catalog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
    }
}