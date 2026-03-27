package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Fornecedor;
import com.fatec.vendas.repositories.FornecedorRepository;

@Service
public class FornecedorService extends AbstractCrudService<Fornecedor, Integer> {
    public FornecedorService(FornecedorRepository repository) {
        super(repository);
    }
}
