<?php

class MY_Controller extends CI_Controller
{
    protected $allowed = [
        2 => [
            'company' => [
                'show',
                'search',
            ],
            'pagseguro' => [
                // 'index',
                'create',
                'return',
            ],
            'dashboard' => [
                'index',
			],
			'cotation' => [
                'import',
            ],
            'wallet' => [
                'index',
                'ranking',
            ],
            'transaction' => [
                'index',
            ],
            'ranking' => [
                'index',
            ],
            'stock' => [
                'buy',
                'save_buy',
                'sell',
                'save_sell',
            ],

        ],
    ];

    protected $redirect = [
        2 => 'dashboard',
    ];

    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wallet_model');
        $this->user = $this->session->userdata('user');
        
        $userwallet = $this->wallet_model->get_by_user($this->user->id_user);
        if($userwallet){
            $sum = 0;
            foreach($userwallet as $w){
                $sum += $w->quantity * $w->average_price;
            }
            $this->user->saldo_ativos = $sum;
            $this->session->set_userdata('user', $this->user);
        }
        
        $this->check();
        setlocale(LC_MONETARY, 'pt_BR');
    }

    public function check()
    {
		$first = $this->uri->segment(1);

		if (in_array($first, ['cotation', 'import', 'update_all'])) {
			return true;
		}

        if (!$this->user) {
            redirect('auth');
        }
        
        if (!$this->can($role_id = $this->user->role_id)) {
            redirect($this->redirect[$role_id]);
		}

		if ($role_id != 2) {
			return true;
		}

    }

    public function can(int $role_id) : bool
    {
        $model = $this->uri->segment(1);
        $action = $this->uri->segment(2) ? : 'index';

        if (($model == 'auth' || $model == 'webhook') || !isset($this->allowed[$role_id])) {
            return true;
        }

        $routes = $this->allowed[$role_id];
        $actions = $routes[$model] ?? [];

        if (in_array($action, $actions)) {
            return true;
        }

        return false;
    }
}
