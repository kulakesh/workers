<?php

namespace App\Livewire;

use App\Models\DocumentHeads;
use App\Models\Documents;
use Livewire\Component;

class DocumentHeadsCreate extends Component
{
    public $document_heads;
    public $document_head_id, $document_head_name, $document_head_type, $document_id, $document_name;

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
        session()->flash('message', 'Head Added');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function addDocument(){
        $this->validate([
            'document_name' => 'required',
        ]);

        Documents::create([
            'name' => $this->document_name,
            'head_id' => $this->document_head_id,
        ]);

        $this->document_heads = DocumentHeads::whereDel(0)->get();
        session()->flash('message', 'Document Added');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function setDocumentId($id){
        $this->document_head_id = $id;
    }
    public function deleteDocumentHead(int $id){
        $this->document_head_id = $id;
    }
    public function destroyDocumentHead(){
        $delete = DocumentHeads::where('id',$this->document_head_id)->update([
            "del" => 1
        ]);
        $this->document_heads = DocumentHeads::whereDel(0)->get();
        session()->flash('message', 'Record Deleted');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function deleteDocument(int $id){
        $this->document_id = $id;
    }
    public function destroyDocument(){
        $delete = Documents::where('id',$this->document_id)->update([
            "del" => 1
        ]);
        $this->document_heads = DocumentHeads::whereDel(0)->get();
        session()->flash('message', 'Record Deleted');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function closeModal()
    {
        $this->resetVals();
    }
    public function resetVals(){
        $this->document_head_id = null;
        $this->document_head_name = null;
        $this->document_head_type = null;
        $this->document_id = null;
        $this->document_name = null;
    }
    public function render()
    {

        return view('livewire.document-heads-create');
    }
}
