package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Produto;
import com.fatec.vendas.repositories.ProdutoRepository;

@Service
public class ProdutoService extends AbstractCrudService<Produto, Integer> {
    public ProdutoService(ProdutoRepository repository) {
        super(repository);
    }
}
