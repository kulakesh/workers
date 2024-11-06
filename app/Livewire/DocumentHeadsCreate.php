<?php

namespace App\Livewire;

use App\Models\DocumentHeads;
use App\Models\Documents;
use Livewire\Component;

class DocumentHeadsCreate extends Component
{
    public $document_heads;
    public $document_head_name, $document_head_type, $document_name;

    public function mount()
    {
        $this->document_heads = DocumentHeads::whereDel(0)->get();
    }
    public function addDocumentHead(){
        $this->validate([
            'document_head_name' => 'required',
            'document_head_type' => 'required',
        ]);

        DocumentHeads::create([
            'name' => $this->document_head_name,
            'type' => $this->document_head_type,
        ]);

        $this->document_heads = DocumentHeads::whereDel(0)->get();
        $this->document_head_name = null;
        $this->document_head_type = null;
    }
    public function addDocument($id){
        $this->validate([
            'document_name' => 'required',
        ]);

        Documents::create([
            'name' => $this->document_name,
            'head_id' => $id,
        ]);

        $this->document_heads = DocumentHeads::whereDel(0)->get();
        $this->document_name = null;
    }
    public function render()
    {

        return view('livewire.document-heads-create');
    }
}
