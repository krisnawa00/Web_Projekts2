import { useEffect, useState } from "react";
import "../css/loader.css";

// Main App
export default function App() {
    const [selectedGameID, setSelectedGameID] = useState(null);

    function handleGameSelection(gameID) {
        setSelectedGameID(gameID);
    }

    function handleGoingBack() {
        setSelectedGameID(null);
    }

    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                {selectedGameID ? (
                    <GamePage
                        selectedGameID={selectedGameID}
                        handleGameSelection={handleGameSelection}
                        handleGoingBack={handleGoingBack}
                    />
                ) : (
                    <Homepage handleGameSelection={handleGameSelection} />
                )}
            </main>
            <Footer />
        </>
    );
}

// Homepage
function Homepage({ handleGameSelection }) {
    const [topGames, setTopGames] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    async function fetchTopGames() {
        try {
            setIsLoading(true);
            setError(null);

            const response = await fetch("http://localhost/data/get-top-games");
            // Optional: Use env var — `${process.env.REACT_APP_API_BASE_URL}/data/get-top-games`

            if (!response.ok) {
                throw new Error("Datu ielādes kļūda. Lūdzu, pārlādējiet lapu!");
            }

            const data = await response.json();
            setTopGames(data);
        } catch (error) {
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
    }

    useEffect(() => {
        fetchTopGames();
    }, []);

    return (
        <>
            {isLoading && <Loader />}
            {error && (
                <>
                    <ErrorMessage msg={error} />
                    <div className="text-center mt-4">
                        <button
                            onClick={fetchTopGames}
                            className="rounded-full py-2 px-4 bg-purple-600 text-white hover:bg-purple-500"
                        >
                            Mēģināt vēlreiz
                        </button>
                    </div>
                </>
            )}
            {!isLoading &&
                !error &&
                topGames.map((game, index) => (
                    <TopGameView
                        game={game}
                        key={game.id}
                        index={index}
                        handleGameSelection={handleGameSelection}
                    />
                ))}
        </>
    );
}

// GamePage
function GamePage({ selectedGameID, handleGameSelection, handleGoingBack }) {
    return (
        <>
            <SelectedGameView
                selectedGameID={selectedGameID}
                handleGoingBack={handleGoingBack}
            />
            <RelatedGameSection
                selectedGameID={selectedGameID}
                handleGameSelection={handleGameSelection}
            />
        </>
    );
}

// SelectedGameView
function SelectedGameView({ selectedGameID, handleGoingBack }) {
    const [selectedGame, setSelectedGame] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchSelectedGame() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch(
                    "http://localhost/data/get-game/" + selectedGameID
                );
                if (!response.ok) {
                    throw new Error(
                        "Datu ielādes kļūda. Lūdzu, pārlādējiet lapu!"
                    );
                }

                const data = await response.json();
                setSelectedGame(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchSelectedGame();
    }, [selectedGameID]);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && (
                <>
                    <div className="rounded-lg flex flex-wrap md:flex-row bg-slate-50 p-6 shadow-lg">
                        <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                            <h1 className="text-3xl font-light mb-2 text-indigo-800">
                                {selectedGame.name}
                            </h1>
                            <p className="text-xl font-light mb-2 text-indigo-600">
                                {selectedGame.develepor}
                            </p>
                            <p className="text-xl font-light mb-4 text-gray-700">
                                {selectedGame.description}
                            </p>
                            <dl className="mb-4 md:flex md:flex-wrap">
                                <dt className="font-bold md:basis-1/4 text-indigo-700">
                                    Izdošanas gads
                                </dt>
                                <dd className="mb-2 md:basis-3/4 text-gray-600">
                                    {selectedGame.release_year}
                                </dd>
                                <dt className="font-bold md:basis-1/4 text-indigo-700">
                                    Cena
                                </dt>
                                <dd className="mb-2 md:basis-3/4 text-gray-600">
                                    € {selectedGame.price}
                                </dd>
                                <dt className="font-bold md:basis-1/4 text-indigo-700">
                                    Žanrs
                                </dt>
                                <dd className="mb-2 md:basis-3/4 text-gray-600">
                                    {selectedGame.genre}
                                </dd>
                            </dl>
                        </div>
                        <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
                            {selectedGame.image && (
                                <img
                                    src={selectedGame.image}
                                    alt={
                                        selectedGame.name || selectedGame.title
                                    }
                                    className="p-1 rounded-md border border-indigo-200 mx-auto w-full max-w-md shadow-md"
                                    onError={(e) => {
                                        e.target.style.display = "none";
                                    }}
                                />
                            )}
                        </div>
                    </div>
                    <div className="mb-12 flex flex-wrap">
                        <GoBackBtn handleGoingBack={handleGoingBack} />
                    </div>
                </>
            )}
        </>
    );
}

// RelatedGameSection
function RelatedGameSection({ selectedGameID, handleGameSelection }) {
    const [relatedGames, setRelatedGames] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchRelatedGames() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch(
                    `http://localhost/data/get-related-games/${selectedGameID}`
                );

                if (!response.ok) {
                    throw new Error("Neizdevās ielādēt līdzīgas spēles");
                }

                const data = await response.json();
                setRelatedGames(data.slice(0, 2)); // Take only first 2 related games
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        if (selectedGameID) {
            fetchRelatedGames();
        }
    }, [selectedGameID]);

    if (isLoading) return <Loader />;
    if (error) return <ErrorMessage msg={error} />;
    if (relatedGames.length === 0) return null;

    return (
        <>
            <h2 className="text-3xl font-light mb-4 text-indigo-800">
                Līdzīgas spēles
            </h2>
            <div className="flex flex-wrap md:space-x-4 md:flex-nowrap">
                {relatedGames.map((game) => (
                    <RelatedGameView
                        game={game}
                        key={game.id}
                        handleGameSelection={handleGameSelection}
                    />
                ))}
            </div>
        </>
    );
}

// RelatedGameView
function RelatedGameView({ game, handleGameSelection }) {
    return (
        <div className="rounded-lg mb-4 md:basis-1/3 bg-white shadow-lg border border-indigo-100 overflow-hidden hover:shadow-xl transition-shadow">
            {game.image && (
                <img
                    src={game.image}
                    alt={game.name || game.title}
                    className="md:h-[400px] md:mx-auto max-md:w-2/4 max-md:mx-auto object-cover"
                    onError={(e) => {
                        e.target.style.display = "none";
                    }}
                />
            )}
            <div className="p-4">
                <h3 className="text-xl font-light mb-4 text-indigo-700">
                    {game.name || game.title}
                </h3>
                <SeeMoreBtn
                    gameID={game.id}
                    handleGameSelection={handleGameSelection}
                />
            </div>
        </div>
    );
}

// TopGameView
function TopGameView({ game, handleGameSelection }) {
    return (
        <div className="mb-6 border-b border-indigo-200 pb-6 bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div className="flex flex-col md:flex-row gap-4">
                <div className="md:w-1/3">
                    {game.image && (
                        <img
                            src={game.image}
                            alt={game.name || game.title}
                            className="w-full h-48 object-cover rounded-lg border border-indigo-100"
                            onError={(e) => {
                                e.target.style.display = "none";
                            }}
                        />
                    )}
                </div>
                <div className="md:w-2/3">
                    <h2 className="text-2xl font-semibold mb-2 text-indigo-800">
                        {game.name || game.title}
                    </h2>
                    <p className="text-gray-600 mb-2">{game.description}</p>
                    <p className="text-lg font-medium mb-4 text-indigo-600">
                        € {game.price}
                    </p>
                    <SeeMoreBtn
                        gameID={game.id}
                        handleGameSelection={handleGameSelection}
                    />
                </div>
            </div>
        </div>
    );
}

// Buttons
function SeeMoreBtn({ gameID, handleGameSelection }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-indigo-600 hover:bg-indigo-500 text-white cursor-pointer transition-colors shadow-md hover:shadow-lg"
            onClick={() => handleGameSelection(gameID)}
        >
            Rādīt vairāk
        </button>
    );
}

function GoBackBtn({ handleGoingBack }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-slate-600 hover:bg-slate-500 text-white cursor-pointer transition-colors shadow-md hover:shadow-lg"
            onClick={handleGoingBack}
        >
            Uz sākumu
        </button>
    );
}

// Header & Footer
function Header() {
    return (
        <header className="bg-gradient-to-r from-indigo-600 to-purple-600 mb-8 py-4 sticky top-0 shadow-lg">
            <div className="px-2 text-white text-xl md:container md:mx-auto font-medium">
                2. Praktiskais Darbs
            </div>
        </header>
    );
}

function Footer() {
    return (
        <footer className="bg-slate-800 mt-8">
            <div className="py-8 md:container md:mx-auto px-2 text-slate-300">
                Kristers Rudzītis, VeA, 2025
            </div>
        </footer>
    );
}

// Loader & ErrorMessage
function Loader() {
    return (
        <div className="my-12 text-center">
            <div className="loader"></div>
        </div>
    );
}

function ErrorMessage({ msg }) {
    return (
        <div className="bg-red-100 border border-red-300 my-8 p-4 text-red-800 text-center rounded-lg">
            {msg}
        </div>
    );
}
