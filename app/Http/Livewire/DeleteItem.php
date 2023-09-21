<?php

namespace App\Http\Livewire;

use App\Facades\Cart;

use Livewire\Component;

class DeleteItem extends Component
{
    
    protected $listeners=['deleted'=>'refresh'];
    public $cartItemId;

    public function mount($cartItemId)
    {
        $this->cartItemId = $cartItemId;
    }
    public function render()
    {
        return view('livewire.delete-item');
    }

    public function deleteCartItem()
    {   
        
        // $cartItem = Cart::findOrFail($this->cartItemId);

        Cart::delete($this->cartItemId);
        
    }
}