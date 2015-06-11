<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class language_controller extends FS_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $change_Str = $this->input->get('change');
        $back_url_Str = $this->input->get('back_url');

        $this->i18n->prevent_auto();
        $this->i18n->set_current_locale($change_Str);

        if(empty($back_url_Str))
        {
            $back_url_Str = base_url();
        }

        header("Location: $back_url_Str");
    }

}

/* End of file i18nmanual.php */
/* Location: ./application/controller/i18nmanual.php */