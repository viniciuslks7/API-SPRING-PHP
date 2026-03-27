package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.fatec.vendas.models.Produto;
import com.fatec.vendas.repositories.CompraProdutoRepository;
import com.fatec.vendas.repositories.ProdutoRepository;

@Service
public class ProdutoService extends AbstractCrudService<Produto, Integer> {

    private final CompraProdutoRepository compraProdutoRepository;

    public ProdutoService(ProdutoRepository repository, CompraProdutoRepository compraProdutoRepository) {
        super(repository);
        this.compraProdutoRepository = compraProdutoRepository;
    }

    @Override
    @Transactional
    public void deleteById(Integer id) {
        compraProdutoRepository.deleteByProdutoId(id);
        super.deleteById(id);
    }
}
