<?php

/**
 * @var string  $voltarUrl
 * @var string  $urlSalvar
 * @var \Src\App\Models\Contrato $item
 */

$inputClass = 'mt-1 block w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-4 focus:ring-slate-100';

// input type="date" exige Y-m-d; se vier datetime do banco, corta nos 10 primeiros caracteres
$dataInicio = substr((string) ($item->getVigencia_inico() ?? ''), 0, 10);
$dataFim    = substr((string) ($item->getVigencia_fim() ?? ''), 0, 10);

?>

<div class="space-y-6">
    <div>
        <a href="<?= $voltarUrl ?>" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
        <h1 class="mt-2 text-2xl font-semibold text-slate-900">Editar Contrato</h1>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form method="POST" action="<?= $urlSalvar ?>">
            <?= csrf() ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $item->getId()) ?>">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="fornecedor" class="block text-sm font-medium text-slate-700">Fornecedor <span class="text-rose-600">*</span></label>
                    <input type="text" id="fornecedor" name="fornecedor" required maxlength="255"
                        value="<?= old('fornecedor', htmlspecialchars($item->getFornecedor() ?? '')) ?>"
                        class="<?= $inputClass ?>">
                    <?= old_error('fornecedor') ?>
                </div>

                <div>
                    <label for="contrato" class="block text-sm font-medium text-slate-700">Nº do Contrato</label>
                    <input type="text" id="contrato" name="contrato" maxlength="100"
                        value="<?= old('contrato', htmlspecialchars($item->getContrato() ?? '')) ?>"
                        class="<?= $inputClass ?>">
                    <?= old_error('contrato') ?>
                </div>

                <div>
                    <label for="sei" class="block text-sm font-medium text-slate-700">SEI</label>
                    <input type="text" id="sei" name="sei" maxlength="100"
                        value="<?= old('sei', htmlspecialchars($item->getSei() ?? '')) ?>"
                        class="<?= $inputClass ?>">
                    <?= old_error('sei') ?>
                </div>

                <div class="sm:col-span-2">
                    <label for="startGov" class="block text-sm font-medium text-slate-700">StartGov</label>
                    <input type="text" id="startGov" name="startGov" maxlength="100"
                        value="<?= old('startGov', htmlspecialchars($item->getStartGov() ?? '')) ?>"
                        class="<?= $inputClass ?>">
                    <?= old_error('startGov') ?>
                </div>

                <div>
                    <label for="vigencia_inico" class="block text-sm font-medium text-slate-700">Início da vigência</label>
                    <input type="date" id="vigencia_inico" name="vigencia_inico"
                        value="<?= old('vigencia_inico', htmlspecialchars($dataInicio)) ?>"
                        class="<?= $inputClass ?>">
                    <?= old_error('vigencia_inico') ?>
                </div>

                <div>
                    <label for="vigencia_fim" class="block text-sm font-medium text-slate-700">Fim da vigência</label>
                    <input type="date" id="vigencia_fim" name="vigencia_fim"
                        value="<?= old('vigencia_fim', htmlspecialchars($dataFim)) ?>"
                        class="<?= $inputClass ?>">
                    <?= old_error('vigencia_fim') ?>
                </div>

                <div class="sm:col-span-2">
                    <label for="objeto" class="block text-sm font-medium text-slate-700">Objeto</label>
                    <textarea id="objeto" name="objeto" maxlength="1000" rows="4"
                        class="<?= $inputClass ?>"
                    ><?= old('objeto', htmlspecialchars($item->getObjeto() ?? '')) ?></textarea>
                    <?= old_error('objeto') ?>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select id="status" name="status" class="<?= $inputClass ?>">
                        <option value="1" <?= $item->getStatus() ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= !$item->getStatus() ? 'selected' : '' ?>>Inativo</option>
                    </select>
                    <?= old_error('status') ?>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="<?= $voltarUrl ?>"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Cancelar
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                    <i class="fa-solid fa-floppy-disk"></i> Atualizar
                </button>
            </div>
        </form>
    </div>
</div>