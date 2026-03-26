package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Cliente;
import com.fatec.vendas.repositories.ClienteRepository;

@Service
public class ClienteService extends AbstractCrudService<Cliente, Integer> {
    public ClienteService(ClienteRepository repository) {
        super(repository);
    }
}
