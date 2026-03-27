package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Fornecedor;
import com.fatec.vendas.services.FornecedorService;

@RestController
@RequestMapping("/fornecedores")
public class FornecedorController extends AbstractCrudController<Fornecedor, Integer> {

    public FornecedorController(FornecedorService service) {
        super(service);
    }

    @Override
    protected void setId(Fornecedor entity, Integer id) {
        entity.setCodfornecedor(id);
    }
}
