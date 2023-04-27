
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            <?php $front = $view_array['front'];echo text($front, $language, 'title'); ?>
                        </h1>
                        
                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Documentation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header"><?php echo text($front, $language, 'title'); ?></div>
            <div class="card-body">
                <?php
                if($language == 'en'){
                    echo 'The game is meant to be played with your whole audience or a bigger group of people, not just one contestant. This is the reason why the money indicator goes up after every question: there will always be people who get the answer right, just like there will be some who get it wrong. Either way, the game is designed to be played until the end, so participants answer all 15 questions and the game ends at 1.000.000$. Counting the right answers has to be done manually for now. However, soon it will be possible to count the correct answers per attendee automatically, and show an overall ranking at the end.';
                }elseif ($language == 'hy'){
                    echo 'Խաղը նախատեսված է ձեր ողջ հանդիսատեսի կամ մարդկանց ավելի մեծ խմբի հետ խաղալու համար, այլ ոչ միայն մեկ մասնակցի հետ: Սա է պատճառը, որ փողի ցուցանիշը ամեն հարցից հետո բարձրանում է. միշտ էլ կլինեն մարդիկ, ովքեր ճիշտ պատասխան կստանան, ճիշտ այնպես, ինչպես կլինեն սխալներ ստացողներ: Ամեն դեպքում, խաղը նախատեսված է մինչև վերջ խաղալու համար, ուստի մասնակիցները պատասխանում են բոլոր 15 հարցերին, և խաղն ավարտվում է 1.000.000$-ով: Ճիշտ պատասխանների հաշվարկն առայժմ պետք է ձեռքով կատարվի: Այնուամենայնիվ, շուտով հնարավոր կլինի ավտոմատ կերպով հաշվել յուրաքանչյուր մասնակցի ճիշտ պատասխանները և վերջում ցույց տալ ընդհանուր վարկանիշը:';
                }
                ?>
            </div>

        </div>
    </div>
</main>
