# VLibras Block (Brazilian Sign Language) — OJS plugin

[![OJS](https://img.shields.io/badge/OJS-3.3%20%7C%203.4%20%7C%203.5-brightgreen)](https://pkp.sfu.ca/ojs/)
[![Version](https://img.shields.io/badge/version-1.0.0.0-blue)](version.xml)
[![License](https://img.shields.io/badge/license-GPL--3.0-lightgrey)](LICENSE)

**⬇️ Install package:** [OJS 3.5](https://github.com/OJSBR/vlibras/releases/download/1.0.0.0/vlibras-1.0.0.0.tar.gz) · [OJS 3.4](https://github.com/OJSBR/vlibras/releases/download/1.0.0.0-ojs3.4/vlibras-1.0.0.0-ojs3.4.tar.gz) · [OJS 3.3](https://github.com/OJSBR/vlibras/releases/download/1.0.0.0-ojs3.3/vlibras-1.0.0.0-ojs3.3.tar.gz) — or browse all [Releases](../../releases).

A **block plugin** for **Open Journal Systems (OJS)** that embeds the official
**[VLibras](https://www.gov.br/governodigital/pt-br/vlibras) widget** — the Brazilian
federal government's Portuguese-to-**Libras** (Brazilian Sign Language) translator, with its
floating 3D avatar — so **deaf readers** can translate the journal's content. No core
patching.

> **Developed and maintained by [OJSBR](https://ojsbr.com.br).** VLibras itself is a product
> of the Brazilian government (see [Credits](#credits--authorship)).

## Compatibility & branches

| OJS version | Branch | Plugin release |
|-------------|--------|----------------|
| OJS 3.5.x   | [`stable-3_5_0`](../../tree/stable-3_5_0) *(default)* | 1.0.0.0 |
| OJS 3.4.x   | [`stable-3_4_0`](../../tree/stable-3_4_0) | 1.0.0.0-ojs3.4 |
| OJS 3.3.x   | [`stable-3_3_0`](../../tree/stable-3_3_0) | 1.0.0.0-ojs3.3 |

## What it does

- Loads the official VLibras widget from `https://vlibras.gov.br/app`, showing the floating
  **Libras avatar** on every front-end page of the journal.
- Readers click the avatar and select text to see it translated into **Libras**.
- Ships a small labelled block for the sidebar so editors can position and describe it.
- **Multilingual** interface strings in 6 languages: English, Portuguese (BR), Spanish,
  French, Italian and German (the widget itself translates Portuguese content to Libras).

## Installation

1. Download the release for your OJS version (or clone the matching branch).
2. Install via **Settings → Website → Plugins → Upload A New Plugin**, or extract the folder
   into `plugins/blocks/` so you get `plugins/blocks/vlibras/`.
3. Enable **VLibras Block (Brazilian Sign Language)** under the *Block* plugins list.
4. Place the block in your sidebar under **Settings → Website → Appearance → Sidebar**.

## How it works (technical)

- A `BlockPlugin` renders `templates/block.tpl`. The template is **self-contained**: a small
  inline script (inside a Smarty `{literal}` block) creates the official VLibras markup
  (`<div vw>…`) as a **direct child of `<body>`** — mirroring VLibras's documented placement
  before `</body>` — so the fixed-positioned avatar is never affected by the sidebar's CSS.
- The widget script is loaded **asynchronously** and initialised on load
  (`new window.VLibras.Widget('https://vlibras.gov.br/app')`), with a **guard** so it loads
  only once per page even if the block renders more than once.
- No core files are changed and no database schema is added; disabling the plugin removes the
  widget entirely.

> **Privacy / availability note.** The widget is served from `vlibras.gov.br` (Brazilian
> government). Enabling this plugin makes readers' browsers load that third-party script; if
> the government service is unavailable, the avatar simply does not appear.

## Credits & authorship

- **VLibras** is developed by the Brazilian Government
  ([Ministério da Gestão e da Inovação em Serviços Públicos](https://www.gov.br/governodigital/pt-br/vlibras)
  / LAViD-UFPB) and distributed by them; this plugin only **embeds** their public widget.
- This **OJS integration plugin** is developed and maintained by
  [OJSBR](https://ojsbr.com.br) and distributed under the **GNU GPL v3**.

## Contributing

Issues and pull requests are welcome. Please target the branch matching the OJS version you
are working against. See [`CONTRIBUTING.md`](CONTRIBUTING.md).

## License

This integration plugin is distributed under the **GNU GPL v3**. See [`LICENSE`](LICENSE) and
`docs/COPYING`. VLibras itself is subject to its own licensing by the Brazilian government.

---

## 🇧🇷 Português

Um **plugin de bloco** para o **Open Journal Systems (OJS)** que incorpora o widget oficial do
**[VLibras](https://www.gov.br/governodigital/pt-br/vlibras)** — o tradutor de Português para
**Libras** (Língua Brasileira de Sinais) do governo federal, com o avatar 3D flutuante — para
que **leitores surdos** possam traduzir o conteúdo da revista. Sem alterar o núcleo do OJS.

> **Desenvolvido e mantido pela [OJSBR](https://ojsbr.com.br).** O VLibras em si é um produto
> do governo brasileiro (veja [Créditos](#créditos-e-autoria)).

### Compatibilidade e branches

| Versão do OJS | Branch | Release do plugin |
|---------------|--------|-------------------|
| OJS 3.5.x     | `stable-3_5_0` *(padrão)* | 1.0.0.0 |
| OJS 3.4.x     | `stable-3_4_0` | 1.0.0.0-ojs3.4 |
| OJS 3.3.x     | `stable-3_3_0` | 1.0.0.0-ojs3.3 |

### O que faz

- Carrega o widget oficial do VLibras de `https://vlibras.gov.br/app`, exibindo o **avatar de
  Libras** flutuante em todas as páginas públicas da revista.
- O leitor clica no avatar e seleciona o texto para vê-lo traduzido em **Libras**.
- Traz um pequeno bloco rotulado para a barra lateral, para o editor posicionar e descrever.
- Interface **multilíngue** em 6 idiomas: inglês, português (BR), espanhol, francês, italiano
  e alemão (o widget em si traduz o conteúdo em português para Libras).

### Instalação

Instale em **Configurações → Website → Plugins → Enviar um novo plugin**, ou extraia a pasta
em `plugins/blocks/` (ficando `plugins/blocks/vlibras/`). Ative o **Bloco VLibras (Libras)** na
lista de plugins de *Bloco* e posicione o bloco em **Configurações → Website → Aparência →
Barra lateral**.

### Como funciona (técnico)

- Um `BlockPlugin` renderiza `templates/block.tpl`. O template é **autossuficiente**: um script
  embutido (num bloco Smarty `{literal}`) cria a marcação oficial do VLibras (`<div vw>…`) como
  **filho direto de `<body>`** — espelhando a colocação documentada do VLibras antes do
  `</body>` — para que o avatar (fixed) nunca sofra efeitos do CSS da barra lateral.
- O script do widget é carregado de forma **assíncrona** e inicializado no `onload`
  (`new window.VLibras.Widget('https://vlibras.gov.br/app')`), com uma **guarda** para carregar
  só uma vez por página, mesmo que o bloco seja renderizado mais de uma vez.
- Nenhum arquivo do núcleo é alterado e nenhum schema de banco é adicionado; desativar o plugin
  remove o widget por completo.

> **Nota de privacidade / disponibilidade.** O widget é servido por `vlibras.gov.br` (governo
> brasileiro). Ativar este plugin faz o navegador dos leitores carregar esse script de
> terceiros; se o serviço do governo estiver indisponível, o avatar simplesmente não aparece.

### Créditos e autoria

- O **VLibras** é desenvolvido pelo Governo Brasileiro
  ([Ministério da Gestão e da Inovação em Serviços Públicos](https://www.gov.br/governodigital/pt-br/vlibras)
  / LAViD-UFPB) e distribuído por ele; este plugin apenas **incorpora** o widget público.
- Este **plugin de integração com o OJS** é desenvolvido e mantido pela
  [OJSBR](https://ojsbr.com.br) e distribuído sob a **GNU GPL v3**.

### Licença

Este plugin de integração é distribuído sob a **GNU GPL v3**. Veja [`LICENSE`](LICENSE) e
`docs/COPYING`. O VLibras em si está sujeito ao licenciamento próprio do governo brasileiro.
