package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Cliente;
import com.fatec.vendas.services.ClienteService;

@RestController
@RequestMapping("/clientes")
public class ClienteController extends AbstractCrudController<Cliente, Integer> {

    public ClienteController(ClienteService service) {
        super(service);
    }

    @Override
    protected void setId(Cliente entity, Integer id) {
        entity.setCodcliente(id);
    }
}
