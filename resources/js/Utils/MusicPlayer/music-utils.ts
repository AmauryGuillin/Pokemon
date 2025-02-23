import { Howl } from "howler";

const MUSICS_LIST = [
    "./musics/emerald/071 - Shop.flac",
    "./musics/perle-diamond-platinum/25 - Poké Mart.flac",
];

function playShopMusics() {
    autoPlay(0, MUSICS_LIST);
}

function autoPlay(i: number, list: string[]) {
    window.sound = new Howl({
        src: [list[i]],
        preload: true,
        volume: 0.1,
        onend: () => {
            if (i + 1 === list.length) {
                autoPlay(0, list);
            } else {
                autoPlay(i + 1, list);
            }
        },
    });
    window.sound.play();
}

export { playShopMusics };
