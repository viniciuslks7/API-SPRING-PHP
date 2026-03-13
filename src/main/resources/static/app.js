const defaultOrigin = window.location.origin && window.location.origin !== "null"
  ? window.location.origin
  : "http://localhost:8090";

const resources = [
  "sexos", "ruas", "bairros", "ufs", "cidades", "ceps",
  "tipos", "marcas", "clientes", "fornecedores", "produtos",
  "compras", "compra-produtos"
];

const idFieldMap = {
  "sexos": "codsexo",
  "ruas": "codrua",
  "bairros": "codbairro",
  "ufs": "coduf",
  "cidades": "codcidade",
  "ceps": "codcep",
  "tipos": "codtipo",
  "marcas": "codmarca",
  "clientes": "codcliente",
  "fornecedores": "codfornecedor",
  "produtos": "codproduto",
  "compras": "codcompra"
};

const samples = {
  "sexos": { "nomesexo": "MASCULINO" },
  "ruas": { "nomerua": "Rua das Flores" },
  "bairros": { "nomebairro": "Centro" },
  "ufs": { "nomeuf": "Sao Paulo", "siglauf": "SP" },
  "cidades": { "nomecidade": "Jales", "uf": { "coduf": 1 } },
  "ceps": { "numerocep": "15700-000" },
  "tipos": { "nometipo": "Eletronico" },
  "marcas": { "nomemarca": "Marca X" },
  "clientes": {
    "nomecliente": "Joao da Silva",
    "sexo": { "codsexo": 1 },
    "rua": { "codrua": 1 },
    "bairro": { "codbairro": 1 },
    "cep": { "codcep": 1 },
    "cidade": { "codcidade": 1 }
  },
  "fornecedores": {
    "nomefornecedor": "Fornecedor ABC",
    "rua": { "codrua": 1 },
    "bairro": { "codbairro": 1 },
    "cep": { "codcep": 1 },
    "cidade": { "codcidade": 1 },
    "telefonefornecedor": "(17) 99999-9999",
    "emailfornecedor": "contato@fornecedor.com"
  },
  "produtos": {
    "nomeproduto": "Mouse Gamer",
    "tipo": { "codtipo": 1 },
    "marca": { "codmarca": 1 },
    "quantidade": 30,
    "valor": 149.90,
    "fornecedor": { "codfornecedor": 1 }
  },
  "compras": {
    "datacompra": "2026-03-04",
    "cliente": { "codcliente": 1 }
  },
  "compra-produtos": {
    "compra": { "codcompra": 1 },
    "produto": { "codproduto": 1 },
    "quantidade": 2,
    "valorcp": 299.80
  }
};

const resourceEl = document.getElementById("resource");
const baseUrlEl = document.getElementById("baseUrl");
const payloadEl = document.getElementById("payload");
const outputEl = document.getElementById("output");
const recordsEl = document.getElementById("records");
const modeLabelEl = document.getElementById("modeLabel");

const idEl = document.getElementById("idValue");
const codCompraEl = document.getElementById("codcompra");
const codProdutoEl = document.getElementById("codproduto");
const singleIdBox = document.getElementById("singleIdBox");
const compositeIdBox = document.getElementById("compositeIdBox");

let mode = "create";
let recordsCache = [];
let selectedKey = null;

baseUrlEl.value = defaultOrigin;

for (const r of resources) {
  const opt = document.createElement("option");
  opt.value = r;
  opt.textContent = r;
  resourceEl.appendChild(opt);
}

function isComposite() {
  return resourceEl.value === "compra-produtos";
}

function getBasePath() {
  return `${baseUrlEl.value.replace(/\/$/, "")}/${resourceEl.value}`;
}

function setOutput(data) {
  outputEl.textContent = typeof data === "string" ? data : JSON.stringify(data, null, 2);
}

function setMode(newMode) {
  mode = newMode;
  modeLabelEl.textContent = newMode === "create" ? "Adicionar" : "Alterar";
}

function clearIds() {
  idEl.value = "";
  codCompraEl.value = "";
  codProdutoEl.value = "";
}

function extractSimpleId(record) {
  const key = idFieldMap[resourceEl.value];
  return key ? record?.[key] : null;
}

function extractCompositeId(record) {
  return {
    codcompra: record?.id?.codcomprafk ?? record?.compra?.codcompra ?? null,
    codproduto: record?.id?.codprodutofk ?? record?.produto?.codproduto ?? null
  };
}

function getRecordKey(record) {
  if (isComposite()) {
    const c = extractCompositeId(record);
    return `${c.codcompra}-${c.codproduto}`;
  }
  return String(extractSimpleId(record));
}

function fillIdsFromRecord(record) {
  if (isComposite()) {
    const c = extractCompositeId(record);
    codCompraEl.value = c.codcompra ?? "";
    codProdutoEl.value = c.codproduto ?? "";
    return;
  }

  idEl.value = extractSimpleId(record) ?? "";
}

function getIdPathFromInputs() {
  if (isComposite()) {
    if (!codCompraEl.value || !codProdutoEl.value) {
      throw new Error("Preencha codcompra e codproduto.");
    }
    return `${getBasePath()}/${codCompraEl.value}/${codProdutoEl.value}`;
  }

  if (!idEl.value) {
    throw new Error("Preencha o ID.");
  }

  return `${getBasePath()}/${idEl.value}`;
}

function getRecordSummary(record) {
  const entries = Object.entries(record || {});
  for (const [key, value] of entries) {
    const isPrimitive = value === null || ["string", "number", "boolean"].includes(typeof value);
    if (isPrimitive && !key.toLowerCase().startsWith("cod")) {
      return `${key}: ${value}`;
    }
  }
  return JSON.stringify(record);
}

async function callApi(method, url, body) {
  const options = {
    method,
    headers: { "Content-Type": "application/json" }
  };

  if (body) {
    options.body = JSON.stringify(body);
  }

  const res = await fetch(url, options);
  const text = await res.text();
  let parsed;

  try {
    parsed = text ? JSON.parse(text) : {};
  } catch {
    parsed = text;
  }

  if (!res.ok) {
    throw new Error(`${res.status} ${res.statusText}\n${typeof parsed === "string" ? parsed : JSON.stringify(parsed, null, 2)}`);
  }

  return parsed;
}

async function loadRecords() {
  try {
    const data = await callApi("GET", getBasePath());
    recordsCache = Array.isArray(data) ? data : [];
    renderRecords();
    setOutput(data);
  } catch (e) {
    setOutput(e.message);
  }
}

function renderRecords() {
  recordsEl.innerHTML = "";

  if (!recordsCache.length) {
    recordsEl.innerHTML = '<p class="empty-msg">Nenhum registro encontrado.</p>';
    return;
  }

  recordsCache.forEach((record) => {
    const key = getRecordKey(record);
    const card = document.createElement("div");
    card.className = `record-card${selectedKey === key ? " selected" : ""}`;

    const header = document.createElement("div");
    header.className = "record-header";

    const idText = document.createElement("div");
    idText.className = "record-id";
    idText.textContent = `ID: ${key}`;

    const actions = document.createElement("div");
    actions.className = "record-actions";

    const btnSelecionar = document.createElement("button");
    btnSelecionar.className = "btn-secondary";
    btnSelecionar.textContent = "Alterar";
    btnSelecionar.addEventListener("click", () => selectRecord(record));

    const btnExcluir = document.createElement("button");
    btnExcluir.className = "btn-danger";
    btnExcluir.textContent = "Excluir";
    btnExcluir.addEventListener("click", () => deleteRecord(record));

    actions.appendChild(btnSelecionar);
    actions.appendChild(btnExcluir);

    header.appendChild(idText);
    header.appendChild(actions);

    const summary = document.createElement("div");
    summary.className = "record-summary";
    summary.textContent = getRecordSummary(record);

    card.appendChild(header);
    card.appendChild(summary);
    recordsEl.appendChild(card);
  });
}

function selectRecord(record) {
  selectedKey = getRecordKey(record);
  fillIdsFromRecord(record);
  payloadEl.value = JSON.stringify(record, null, 2);
  setMode("update");
  renderRecords();
  setOutput("Registro selecionado para alteracao.");
}

async function deleteRecord(record) {
  try {
    fillIdsFromRecord(record);
    const path = getIdPathFromInputs();
    await callApi("DELETE", path);
    setOutput("Registro excluido com sucesso.");
    selectedKey = null;
    setMode("create");
    clearIds();
    loadSample();
    await loadRecords();
  } catch (e) {
    setOutput(e.message);
  }
}

function refreshMode() {
  if (isComposite()) {
    singleIdBox.classList.add("hidden");
    compositeIdBox.classList.remove("hidden");
  } else {
    singleIdBox.classList.remove("hidden");
    compositeIdBox.classList.add("hidden");
  }
}

function loadSample() {
  payloadEl.value = JSON.stringify(samples[resourceEl.value], null, 2);
}

resourceEl.addEventListener("change", async () => {
  selectedKey = null;
  clearIds();
  setMode("create");
  refreshMode();
  loadSample();
  await loadRecords();
});

document.getElementById("btnAtualizarLista").addEventListener("click", loadRecords);
document.getElementById("btnExemplo").addEventListener("click", loadSample);

document.getElementById("btnAdicionar").addEventListener("click", () => {
  selectedKey = null;
  clearIds();
  setMode("create");
  loadSample();
  renderRecords();
  setOutput("Modo adicionar ativo.");
});

document.getElementById("btnAlterar").addEventListener("click", () => {
  if (!selectedKey) {
    setOutput("Selecione um registro na lista para alterar.");
    return;
  }
  setMode("update");
  setOutput("Modo alterar ativo.");
});

document.getElementById("btnExcluir").addEventListener("click", async () => {
  if (!selectedKey) {
    setOutput("Selecione um registro na lista para excluir.");
    return;
  }

  const record = recordsCache.find((r) => getRecordKey(r) === selectedKey);
  if (!record) {
    setOutput("Registro selecionado nao encontrado na lista atual.");
    return;
  }

  await deleteRecord(record);
});

document.getElementById("btnSalvar").addEventListener("click", async () => {
  try {
    const body = JSON.parse(payloadEl.value || "{}");

    if (mode === "create") {
      const created = await callApi("POST", getBasePath(), body);
      setOutput(created);
    } else {
      const path = getIdPathFromInputs();
      const updated = await callApi("PUT", path, body);
      setOutput(updated);
    }

    await loadRecords();
  } catch (e) {
    setOutput(e.message);
  }
});

document.getElementById("btnCancelar").addEventListener("click", () => {
  selectedKey = null;
  clearIds();
  setMode("create");
  loadSample();
  renderRecords();
  setOutput("Edicao cancelada.");
});

refreshMode();
loadSample();
loadRecords();