<?php


namespace App\Http\Controllers;


use App\Models\Produto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    /**
     * Listar todos os produtos cadastrados
     */
    public function index(): View
    {
        return view("produtos.index", [
            "produto" => Produto::all(), // busca todos os produtos do banco
            "titulo"   => "Catálogo de Produtos Industriais"
        ]);
    }


    /**
     * Exibir um formulário para cadastro de novos produtos
     */
    public function create(): View
    {
        return view("produto.create", [
            "titulo" => "Novo Cadastro de Produto"
        ]);
    }


    /**
     * Salva os dados do novo produto no banco de dados usando o request e dando uma response
     */
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            "nome"       => "required|min:3|unique:produto,nome",
            "fabricante" => "required|min:2",
            "quantidade" => "required|integer|min:0",
            "valor"      => "required|numeric|min:0"
        ]);


        // Fazer o cadastro no banco
        Produto::create($dados);
        return redirect()->route("produtos.index")->with("sucesso", "Produto cadastrado com sucesso");
    }


    /**
     * Exibir os detalhes de um produto específico
     */
    public function show(int $id): View
    {
        $produto = Produto::findOrFail($id); // manda uma mensagem de erro caso nao encontrado


        return view("produto.show", [
            "produto" => $produto,
            "titulo"  => "Ficha técnica: {$produto['nome']}"
        ]);
    }


    /**
     * Exibir um formulário com os dados de um produto específico para atualização
     */
    public function edit(int $id): View
    {
        $produto = Produto::findOrFail($id);


        return view("produto.edit", [
            "produto" => $produto,
            "titulo"  => "Editar Produto {$produto['nome']}"
        ]);
    }


    /**
     * Atualizar os dados do produto utilizando Method Spoofing (PUT)
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $dados = $request->validate([
            "nome"       => "required|min:3|unique:produto,nome," . $id,
            "fabricante" => "required|min:2",
            "quantidade" => "required|integer|min:0",
            "valor"      => "required|numeric|min:0"
        ]);


        Produto::findOrFail($id)->update($dados);
        return redirect()->route("produto.show", $id)->with("sucesso", "Dados do produto atualizados com sucesso");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Produto::findOrFail($id)->delete();
        return redirect()->route("produto.index")->with("sucesso", "Produto removido do sistema");
    }


    /**
     * Filtragem de produtos por fabricante
     */
    public function filtrarPorFabricante(?string $fabricante = null): View
    {
        $consulta = Produto::query();
        if ($fabricante !== null) {
            $consulta->where("fabricante", "like", "%{$fabricante}%");
        }


        return view("produto.index", [
            "produto" => $consulta->get(),
            "titulo"   => $fabricante ? "Fabricante: " . ucfirst($fabricante) : "Todos os Fabricantes"
        ]);
    }
}