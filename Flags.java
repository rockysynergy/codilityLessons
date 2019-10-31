import java.util.HashMap;


class Flags {
    private HashMap<Integer, Boolean> peaks = new HashMap<>();
    private int first = -1;

    public int solution(int[] A) {
        findPeaks(A);
        int L = A.length;
        if (peaks.size() < 1) return 0;


        int lo = 0;
        int hi = L - 1;
        while (lo <= hi) {
            int mid = lo + (hi - lo) / 2;
            if (check(mid, A)) lo = mid + 1;
            else hi = mid - 1;
        }
        return lo-1;
    }

    private void findPeaks(int[] A) {
        int L = A.length;
        for (int i = 1; i < L-1; i++) {
            if (A[i-1] < A[i] && A[i] > A[i+1]) {
                peaks.put(i, true);
                if (first == -1) first = i;
            }
        }
    }

    private boolean check(int x, int[] A) {
        int pos = first;
        int flags = x;
        int L = A.length;
        while (pos < L && flags > 0) {
            if (peaks.containsKey(pos)) {
                flags--;
                pos += x;
            } else {
                pos++;
            }
        }

        return flags == 0;
    }

    public static void main(String[] args) {
        Flags f = new Flags();
        int[] A = new int[] {0, 0, 1, 0, 1, 0, 1};
        System.out.println(f.solution(A));

        // HashMap<Integer, Boolean> B= new HashMap<>();
        // B.put(1, true);
        // boolean C;
        // for (int i = 0; i < 4; i++) {
        //     C = B.get(i);
        //     if (C) {
        //         System.out.println("True for " + i);
        //     }
        // }
    }
}