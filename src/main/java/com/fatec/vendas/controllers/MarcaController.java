package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Marca;
import com.fatec.vendas.services.MarcaService;

@RestController
@RequestMapping("/marcas")
public class MarcaController extends AbstractCrudController<Marca, Integer> {

    public MarcaController(MarcaService service) {
        super(service);
    }

    @Override
    protected void setId(Marca entity, Integer id) {
        entity.setCodmarca(id);
    }
}
