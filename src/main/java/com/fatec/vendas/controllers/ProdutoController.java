package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Produto;
import com.fatec.vendas.services.ProdutoService;

@RestController
@RequestMapping("/produtos")
public class ProdutoController extends AbstractCrudController<Produto, Integer> {

    public ProdutoController(ProdutoService service) {
        super(service);
    }

    @Override
    protected void setId(Produto entity, Integer id) {
        entity.setCodproduto(id);
    }
}
