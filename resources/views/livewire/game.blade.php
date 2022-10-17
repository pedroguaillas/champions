<div>
    {{-- In work, do what you enjoy. --}}

    <x-adminlte-card title="{{ $game['t1_name'] . ' VS ' . $game['t2_name'] }}" theme="info">

        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th style="width: .3em;"></th>
                        <th>{{ $game['t1_name'] }}</th>
                        <th class="text-right">{{ $game['t2_name'] }}</th>
                        <th style="width: .3em;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($game_items as $game_item)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <x-adminlte-button wire:click="goal({{ $game_item['p1_id'] }})" wire:loading.attr="disabled" theme="info" label="{{ $game_item['p1_goals'] }}" class="px-1" />
                            </div>
                        </td>
                        <td>{{ $game_item['p1_name'] }}</td>
                        <td class="text-right">{{ $game_item['p2_name'] }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <x-adminlte-button wire:click="goal({{ $game_item['p2_id'] }})" wire:loading.attr="disabled" theme="info" label="{{ $game_item['p2_goals'] }}" class="px-1" />
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <input type="checkbox" value="gamed" label="Finalizado" wire:model="gamed" />
        </div>
    </x-adminlte-card>
</div>