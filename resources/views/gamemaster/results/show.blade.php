<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        
        <x-page-title>
            {{ __('messages.results') }}
        </x-page-title>


        @foreach ($companies as $company)
        <?php
        $guv = $guvs[$company->id];
        $bilanz = $bilanzen[$company->id];
        ?>

        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <details>
            <summary class="cursor-pointer">
                <x-simple-text :text="__('messages.results') . ' ' . $company->name" />
            </summary>

            <!-- List of Decisions -->
            <div class="mt-8">


                <x-simple-text :class="'text-2xl text-center underline'" :text="__('messages.guv') . ':'" />

                <!-- Company List Grouped by Game with Stylish List Items -->
                <div class="mt-8 space-y-8">
                    <div class="space-y-4">
                        <table class="table-fixed mx-auto">
                            <thead>
                                <tr>
                                    <th class="text-left font-bold border-b pb-2">{{ __('messages.expenses') }}</th>
                                    <th class="text-left font-bold border-b border-r pb-2 pr-4 text-right">{{ number_format($guv['aufwendungen_sum'], 0, ',', '.') }} €</th>
                                    <th class="text-left font-bold border-b pb-2">{{ __('messages.earnings') }}</th>
                                    <th class="text-left font-bold border-b pb-2 pr-4 text-right">{{ number_format($guv['ertraege_sum'], 0, ',', '.') }} €</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $maxRows = max(count($guv['aufwendungen']), count($guv['ertraege']));
                                @endphp
                                @for($i = 0; $i < $maxRows; $i++)
                                    <tr>
                                    <td class="pl-4 align-top">
                                        @if(isset($guv['aufwendungen'][$i]))
                                        {{ __('accounts.' . $guv['aufwendungen'][$i]['konto']) }}
                                        @endif
                                    </td>
                                    <td class="border-r pl-4 pr-4 align-top text-right">
                                        @if(isset($guv['aufwendungen'][$i]))
                                        {{ number_format($guv['aufwendungen'][$i]['saldo'], 0, ',', '.') }} €
                                        @endif
                                    </td>
                                    <td class="pl-4 align-top">
                                        @if(isset($guv['ertraege'][$i]))
                                        {{ __('accounts.' . $guv['ertraege'][$i]['konto']) }}
                                        @endif
                                    </td>
                                    <td class="pl-4 pr-4 align-top text-right">
                                        @if(isset($guv['ertraege'][$i]))
                                        {{ number_format($guv['ertraege'][$i]['saldo'], 0, ',', '.') }} €
                                        @endif
                                    </td>
                                    </tr>
                                    @endfor

                            </tbody>
                        </table>
                        <h2>{{ __('messages.result') }}: {{ number_format($guv['ergebnis'], 0, ',', '.') }} €</h2>
                    </div>
                </div>

            </div>
            <!-- List of Bilanz -->
            <div class="mt-8">

                <x-simple-text :class="'text-2xl text-center underline'" :text="__('messages.bilanz') . ':'" />


                <!-- Company List Grouped by Game with Stylish List Items -->
                <div class="mt-8 space-y-8">
                    <div class="space-y-4">
                        <table class="table-fixed mx-auto">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-left font-bold border-b border-r pb-2">{{ __('messages.assets') }}</th>
                                    <th colspan="2" class="text-left font-bold border-b pb-2">{{ __('messages.liabilities') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- AV & EK -->
                                <tr>
                                    <td colspan="2" class="font-bold border-r pt-4">{{ __('messages.fixedAssets') }}
                                    <td colspan="2" class="font-bold pt-4">{{ __('messages.equityCapital') }}
                                </tr>
                                @php
                                $maxRowsAV_EK = max(count($bilanz['aktiva']['av']), count($bilanz['passiva']['ek']));
                                @endphp
                                @for($i = 0; $i < $maxRowsAV_EK; $i++)
                                    <tr>
                                    <td class="pl-4 align-top">
                                        @if(isset($bilanz['aktiva']['av'][$i]))
                                        {{ __('accounts.' . $bilanz['aktiva']['av'][$i]['konto']) }}
                                        @endif
                                    </td>
                                    <td class="border-r pl-4 pr-4 align-top text-right">
                                        @if(isset($bilanz['aktiva']['av'][$i]))
                                        {{ number_format($bilanz['aktiva']['av'][$i]['saldo'], 0, ',', '.') }} €
                                        @endif
                                    </td>
                                    <td class="pl-4 align-top">
                                        @if(isset($bilanz['passiva']['ek'][$i]))
                                        {{ __('accounts.' . $bilanz['passiva']['ek'][$i]['konto']) }}
                                        @endif
                                    </td>
                                    <td class="pl-4 pr-4 align-top text-right">
                                        @if(isset($bilanz['passiva']['ek'][$i]))
                                        {{ number_format($bilanz['passiva']['ek'][$i]['saldo'], 0, ',', '.') }} €
                                        @endif
                                    </td>
                                    </tr>
                                    @endfor
                                    <!-- UV & FK -->
                                    <tr>
                                        <td colspan="2" class="font-bold border-r pt-4">{{ __('messages.currentAssets') }}</td>
                                        <td colspan="2" class="font-bold pt-4">{{ __('messages.borrowedCapital') }}</td>
                                    </tr>
                                    @php
                                    $maxRowsUV_FK = max(count($bilanz['aktiva']['uv']), count($bilanz['passiva']['fk']));
                                    @endphp
                                    @for($i = 0; $i < $maxRowsUV_FK; $i++)
                                        <tr>
                                        <td class="pl-4 align-top">
                                            @if(isset($bilanz['aktiva']['uv'][$i]))
                                            {{ __('accounts.' . $bilanz['aktiva']['uv'][$i]['konto']) }}
                                            @endif
                                        </td>
                                        <td class="border-r pr-4 align-top text-right">
                                            @if(isset($bilanz['aktiva']['uv'][$i]))
                                            {{ number_format($bilanz['aktiva']['uv'][$i]['saldo'], 0, ',', '.') }} €
                                            @endif
                                        </td>
                                        <td class="pl-4 align-top">
                                            @if(isset($bilanz['passiva']['fk'][$i]))
                                            {{ __('accounts.' . $bilanz['passiva']['fk'][$i]['konto']) }}
                                            @endif
                                        </td>
                                        <td class="pl-4 pr-4 align-top text-right">
                                            @if(isset($bilanz['passiva']['fk'][$i]))
                                            {{ number_format($bilanz['passiva']['fk'][$i]['saldo'], 0, ',', '.') }} €
                                            @endif
                                        </td>
                                        </tr>
                                        @endfor
                                        <!-- Gesamtsummen -->
                                        <tr class="font-bold border-t">
                                            <td class="pr-4 pt-4">
                                                =
                                            </td>
                                            <td class="border-r pr-4 pt-4 text-right">
                                                {{ number_format($bilanz['activa_sum'], 0, ',', '.') }} €
                                            </td>
                                            <td class="pt-4">
                                                =
                                            </td>
                                            <td class="pl-4 pr-4 pt-4 text-right">
                                                {{ number_format($bilanz['passiva_sum'], 0, ',', '.') }} €
                                            </td>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </details>
        @endforeach

    </x-content-box>
    <div class="text-center mt-6">
            <x-back-button href="{{ route('decisions.check', [$game, $period]) }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
</x-app-layout>